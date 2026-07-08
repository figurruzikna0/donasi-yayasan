<?php

namespace App\Http\Controllers;

use App\Mail\DonationSuccessMail;
use App\Mail\SponsorshipSuccessMail;
use App\Models\Sponsorship;
use App\Services\FonnteService;
use App\Traits\HandlesFileUpload;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\FosterChild;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Snap;

class DonationController extends Controller
{
    use HandlesFileUpload;
    private function initMidtrans()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    public function create(Campaign $campaign)
    {
        return view('donations.create', compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'donor_name'     => 'required|string|max:255',
            'donor_email'    => 'required|email|max:255',
            'donor_phone'    => 'required|string|max:20',
            'amount'         => 'required|numeric|min:1000',
            'payment_method' => 'required|string|max:255',
        ]);

        $orderId  = 'DONASI-' . uniqid();

        $donation = Donation::create([
            'campaign_id'    => $campaign->id,
            'user_id'        => $user->id,
            'order_id'       => $orderId,
            'donor_name'     => $validated['donor_name'],
            'donor_email'    => $validated['donor_email'],
            'donor_phone'    => $validated['donor_phone'],
            'amount'         => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'status'         => 'pending',
        ]);

        if ($validated['payment_method'] === 'QRIS Yayasan') {
            return view('donations.qris_payment', compact('donation', 'campaign'));
        }

        $this->initMidtrans();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $donation->amount,
            ],
            'customer_details' => [
                'first_name' => $donation->donor_name,
                'email'      => $donation->donor_email,
                'phone'      => $donation->donor_phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $donation->update(['snap_token' => $snapToken]);

        return view('donations.payment', compact('donation', 'campaign', 'snapToken'));
    }

    public function sponsorForm($id)
    {
        $child = FosterChild::findOrFail($id);
        return view('donations.sponsor', compact('child'));
    }

    public function sponsorStore(Request $request, $id)
    {
        $child = FosterChild::findOrFail($id);
        $user  = auth()->user();

        $validated = $request->validate([
            'donor_name'     => 'required|string|max:255',
            'donor_email'    => 'required|email|max:255',
            'donor_phone'    => 'required|string|max:20',
            'amount'         => 'required|numeric|min:100000|max:500000',
            'paket_komitmen' => 'required|string|max:255',
            'description'    => 'nullable|string',
            'payment_method' => 'required|string|max:255',
        ]);

        $orderId = 'SPONSOR-' . uniqid();

        $sponsorship = Sponsorship::create([
            'foster_child_id'     => $child->id,
            'user_id'             => $user->id,
            'order_id'            => $orderId,
            'donor_name'          => $validated['donor_name'],
            'donor_email'         => $validated['donor_email'],
            'donor_phone'         => $validated['donor_phone'],
            'amount'              => $validated['amount'],
            'package'             => $validated['paket_komitmen'],
            'package_description' => $validated['description'] ?? null,
            'payment_method'      => $validated['payment_method'],
            'status'              => 'pending',
        ]);

        if ($validated['payment_method'] === 'QRIS Yayasan') {
            return view('donations.qris_payment', compact('sponsorship', 'child'));
        }

        $this->initMidtrans();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $sponsorship->amount,
            ],
            'customer_details' => [
                'first_name' => $sponsorship->donor_name,
                'email'      => $sponsorship->donor_email,
                'phone'      => $sponsorship->donor_phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $sponsorship->update(['snap_token' => $snapToken]);

        return view('donations.sponsor_payment', compact('sponsorship', 'child', 'snapToken'));
    }

    public function uploadQris(Request $request)
    {
        $validated = $request->validate([
            'order_id'       => 'required|string',
            'payment_proof'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $type = str_starts_with($validated['order_id'], 'SPONSOR-') ? 'sponsorship' : 'donation';

        if ($type === 'sponsorship') {
            $sponsorship = Sponsorship::where('order_id', $validated['order_id'])->firstOrFail();
            $sponsorship->update([
                'payment_proof' => $this->uploadFile($request->file('payment_proof'), 'payment-proofs'),
            ]);
            return redirect()->route('invoice.sponsorship', $sponsorship->id)
                ->with('success', 'Bukti pembayaran berhasil diupload. Menunggu konfirmasi admin.');
        }

        $donation = Donation::where('order_id', $validated['order_id'])->firstOrFail();
        $donation->update([
            'payment_proof' => $this->uploadFile($request->file('payment_proof'), 'payment-proofs'),
        ]);
        return redirect()->route('invoice.donation', $donation->id)
            ->with('success', 'Bukti pembayaran berhasil diupload. Menunggu konfirmasi admin.');
    }

    public function callback(Request $request)
    {
        $this->initMidtrans();

        $notification = new \Midtrans\Notification();
        $status       = $notification->transaction_status;
        $orderId      = $notification->order_id;

        try {
            $paymentMethod = $this->extractPaymentMethod($notification);
        } catch (\Throwable $e) {
            $paymentMethod = null;
        }

        // ── Sponsorship ──
        if (str_starts_with($orderId, 'SPONSOR-')) {
            $sponsorship = Sponsorship::where('order_id', $orderId)->first();

            if ($sponsorship) {
                if (in_array($status, ['settlement', 'capture'])) {
                    $sponsorship->update([
                        'status'         => 'success',
                        'starts_at'      => now(),
                        'expires_at'     => now()->addMonth(),
                        'payment_method' => $paymentMethod ?? $sponsorship->payment_method,
                    ]);

                    $child = FosterChild::find($sponsorship->foster_child_id);
                    if ($child) {
                        $child->update(['status' => 'Diasuh']);
                    }

                    // ✅ Kirim notifikasi WA ke donatur
                    if ($sponsorship->donor_phone) {
                        try {
                            $this->kirimWaSponsor($sponsorship, $child);
                        } catch (\Throwable $e) {
                            \Illuminate\Support\Facades\Log::error('Gagal kirim WA: ' . $e->getMessage());
                        }
                    }

                    // ✅ Kirim notifikasi email ke donatur
                    if ($sponsorship->donor_email) {
                        try {
                            Mail::to($sponsorship->donor_email)->send(new SponsorshipSuccessMail($sponsorship));
                        } catch (\Throwable $e) {
                            \Illuminate\Support\Facades\Log::error('Gagal kirim email sponsorship: ' . $e->getMessage());
                        }
                    }

                } elseif ($status === 'pending') {
                    $sponsorship->update(['status' => 'pending']);
                } else {
                    $sponsorship->update(['status' => 'failed']);
                }
            }

        // ── Donasi kampanye ──
        } else {
            $donation = Donation::where('order_id', $orderId)->first();

            if ($donation) {
                if (in_array($status, ['settlement', 'capture'])) {
                    $donation->update([
                        'status'         => 'success',
                        'payment_method' => $paymentMethod,
                    ]);

                    $campaign = Campaign::find($donation->campaign_id);
                    if ($campaign) {
                        $campaign->increment('collected_amount', $donation->amount);
                    }

                    // ✅ Kirim notifikasi WA ke donatur
                    if ($donation->donor_phone) {
                        try {
                            $this->kirimWaDonasi($donation, $campaign);
                        } catch (\Throwable $e) {
                            \Illuminate\Support\Facades\Log::error('Gagal kirim WA donasi: ' . $e->getMessage());
                        }
                    }

                    // ✅ Kirim notifikasi email ke donatur
                    if ($donation->donor_email) {
                        try {
                            Mail::to($donation->donor_email)->send(new DonationSuccessMail($donation));
                        } catch (\Throwable $e) {
                            \Illuminate\Support\Facades\Log::error('Gagal kirim email donasi: ' . $e->getMessage());
                        }
                    }
                } elseif ($status === 'pending') {
                    $donation->update(['status' => 'pending']);
                } else {
                    $donation->update(['status' => 'failed']);
                }
            }
        }

        return response()->json(['message' => 'Laporan diterima']);
    }

    // ── Private: format pesan & kirim WA ──
    private function kirimWaSponsor(Sponsorship $sponsorship, ?FosterChild $child): void
    {
        $fonnte      = new FonnteService();
        $namaAnak    = $child?->name ?? 'anak asuh';
        $usiaAnak    = $child?->age  ? $child->age . ' tahun' : '-';
        $kelamin     = $child?->jenis_kelamin ?? '-';
        $paket       = $sponsorship->package   ?? '-';
        $nominal     = 'Rp ' . number_format($sponsorship->amount, 0, ',', '.');
        $mulai       = $sponsorship->starts_at
                         ? \Carbon\Carbon::parse($sponsorship->starts_at)->translatedFormat('d F Y')
                         : now()->translatedFormat('d F Y');
        $berakhir    = $sponsorship->expires_at
                         ? \Carbon\Carbon::parse($sponsorship->expires_at)->translatedFormat('d F Y')
                         : now()->addMonth()->translatedFormat('d F Y');
        $orderId     = $sponsorship->order_id;
        $donatur     = $sponsorship->donor_name;
        $metode      = $sponsorship->payment_method ?? '-';

        $pesan = "Assalamu'alaikum, *{$donatur}* 🌿\n\n"
               . "✅ *Sponsorship Anak Asuh Berhasil!*\n\n"
               . "Terima kasih telah menjadi Orang Tua Asuh. Kepedulian Anda sangat berarti bagi masa depan anak-anak kami. 🤲\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "👦 *Data Anak Asuh*\n"
               . "Nama   : {$namaAnak}\n"
               . "Usia   : {$usiaAnak}\n"
               . "J.Kelamin: {$kelamin}\n\n"
               . "📦 *Rincian Paket*\n"
               . "Paket  : {$paket}\n"
               . "Nominal: {$nominal}\n"
               . "Metode : {$metode}\n"
               . "Berlaku: {$mulai} s/d {$berakhir}\n\n"
               . "🆔 *ID Transaksi*\n"
               . "{$orderId}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Semoga Allah SWT membalas kebaikan Anda dengan berlipat ganda. Aamiin 🤍\n\n"
               . "_Baitul Yatim_";

        $fonnte->send($sponsorship->donor_phone, $pesan);
    }

    private function kirimWaDonasi(Donation $donation, ?Campaign $campaign): void
    {
        $fonnte = new FonnteService();
        $nama   = $donation->donor_name;
        $judul  = $campaign?->title ?? 'Program Donasi';
        $nominal = 'Rp ' . number_format($donation->amount, 0, ',', '.');
        $metode  = $donation->payment_method ?? '-';
        $orderId = $donation->order_id;
        $tanggal = $donation->created_at
                     ? \Carbon\Carbon::parse($donation->created_at)->translatedFormat('d F Y H:i')
                     : now()->translatedFormat('d F Y H:i');

        $pesan = "Assalamu'alaikum, *{$nama}* 🌿\n\n"
               . "✅ *Donasi Berhasil!*\n\n"
               . "Alhamdulillah, pembayaran donasi Anda telah kami terima. Semoga menjadi amal jariyah yang tak terputus pahalanya. 🤲\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "📋 *Rincian Donasi*\n"
               . "Program : {$judul}\n"
               . "Nominal : {$nominal}\n"
               . "Metode  : {$metode}\n"
               . "Tanggal : {$tanggal}\n\n"
               . "🆔 *ID Transaksi*\n"
               . "{$orderId}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Terima kasih atas kepercayaan dan kebaikan Anda. Semoga Allah SWT membalas dengan berlipat ganda. Aamiin 🤍\n\n"
               . "_Baitul Yatim_";

        $fonnte->send($donation->donor_phone, $pesan);
    }

    private function extractPaymentMethod($notification): ?string
    {
        $type = $notification->payment_type ?? null;

        if (!$type) return null;

        if ($type === 'bank_transfer') {
            $vaNumbers = $notification->va_numbers ?? null;
            $bank      = null;
            if (is_array($vaNumbers) && isset($vaNumbers[0])) {
                $first = $vaNumbers[0];
                $bank  = is_object($first) ? ($first->bank ?? null) : ($first['bank'] ?? null);
            }
            return $bank ? 'Transfer Bank ' . strtoupper($bank) : 'Transfer Bank';
        }

        if ($type === 'echannel')   return 'Mandiri Bill Payment';
        if ($type === 'cstore') {
            $store = $notification->store ?? null;
            return $store ? ucfirst($store) : 'Convenience Store';
        }
        if ($type === 'credit_card') {
            $bank = $notification->bank ?? null;
            return $bank ? 'Kartu Kredit (' . strtoupper($bank) . ')' : 'Kartu Kredit';
        }

        $labels = [
            'gopay'      => 'GoPay',
            'qris'       => 'QRIS',
            'shopeepay'  => 'ShopeePay',
            'akulaku'    => 'Akulaku',
        ];

        return $labels[$type] ?? strtoupper(str_replace('_', ' ', $type));
    }
}