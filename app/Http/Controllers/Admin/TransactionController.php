<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DonationSuccessMail;
use App\Mail\SponsorshipSuccessMail;
use App\Models\Donation;
use App\Models\Sponsorship;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $donations = Donation::with('campaign')->latest()->get()->map(function ($item) {
            return (object) [
                'order_id'       => $item->order_id,
                'donor_name'     => $item->donor_name,
                'donor_email'    => $item->donor_email,
                'amount'         => $item->amount,
                'target'         => $item->campaign->title ?? '-',
                'payment_method' => $item->payment_method,
                'status'         => $item->status,
                'created_at'     => $item->created_at,
            ];
        });

        $sponsorships = Sponsorship::with('fosterChild')->latest()->get()->map(function ($item) {
            return (object) [
                'order_id'       => $item->order_id,
                'donor_name'     => $item->donor_name,
                'donor_email'    => $item->donor_email,
                'donor_phone'    => $item->donor_phone,
                'amount'         => $item->amount,
                'target'         => $item->fosterChild->name ?? '-',
                'package'        => $item->package,
                'payment_method' => $item->payment_method,
                'status'         => $item->status,
                'created_at'     => $item->created_at,
            ];
        });

        return view('admin.transactions.index', compact('donations', 'sponsorships'));
    }

    public function approve($id)
    {
        // ── Sponsorship ──
        if (str_starts_with($id, 'SPONSOR-')) {
            $sponsorship = Sponsorship::with('fosterChild')
                ->where('order_id', $id)
                ->first();

            if (!$sponsorship) {
                return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
            }

            $sponsorship->update([
                'status'     => 'success',
                'starts_at'  => $sponsorship->starts_at  ?? now(),
                'expires_at' => $sponsorship->expires_at ?? now()->addMonth(),
            ]);

            $sponsorship->fosterChild?->update(['status' => 'Diasuh']);

            // Kirim notifikasi WA ke donatur
            if ($sponsorship->donor_phone) {
                $this->kirimWaSponsor($sponsorship);
            }

            // Kirim notifikasi email ke donatur
            if ($sponsorship->donor_email) {
                try {
                    Mail::to($sponsorship->donor_email)->send(new SponsorshipSuccessMail($sponsorship));
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Gagal kirim email sponsorship: ' . $e->getMessage());
                }
            }

            return redirect()->back()->with('success', 'Sponsorship berhasil disetujui!');
        }

        // ── Donasi kampanye ──
        $donation = Donation::where('order_id', $id)->first();

        if (!$donation) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        $donation->update(['status' => 'success']);
        $donation->campaign?->increment('collected_amount', $donation->amount);

        // Kirim notifikasi email ke donatur
        if ($donation->donor_email) {
            try {
                Mail::to($donation->donor_email)->send(new DonationSuccessMail($donation));
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Gagal kirim email donasi: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Transaksi berhasil disetujui!');
    }

    public function destroy($id)
    {
        if (str_starts_with($id, 'SPONSOR-')) {
            $sponsorship = Sponsorship::where('order_id', $id)->first();

            if (!$sponsorship) {
                return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
            }

            $sponsorship->delete();
            return redirect()->back()->with('success', 'Data sponsorship berhasil dihapus!');
        }

        $donation = Donation::where('order_id', $id)->first();

        if (!$donation) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        $donation->delete();
        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus dari sistem!');
    }

    public function sync($id)
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        try {
            $status = Transaction::status($id);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal sync: ' . $e->getMessage());
        }

        $midtransStatus = $status->transaction_status ?? '';

        if (str_starts_with($id, 'SPONSOR-')) {
            $sponsorship = Sponsorship::where('order_id', $id)->first();
            if (!$sponsorship) {
                return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
            }

            if (in_array($midtransStatus, ['settlement', 'capture'])) {
                $sponsorship->update([
                    'status'     => 'success',
                    'starts_at'  => $sponsorship->starts_at ?? now(),
                    'expires_at' => $sponsorship->expires_at ?? now()->addMonth(),
                ]);
                $sponsorship->fosterChild?->update(['status' => 'Diasuh']);

                if ($sponsorship->donor_email) {
                    try {
                        Mail::to($sponsorship->donor_email)->send(new SponsorshipSuccessMail($sponsorship));
                    } catch (\Throwable $e) {
                        \Illuminate\Support\Facades\Log::error('Gagal kirim email sponsorship: ' . $e->getMessage());
                    }
                }

                return redirect()->back()->with('success', 'Sync: Sponsorship sukses (settlement).');
            } elseif (in_array($midtransStatus, ['deny', 'cancel', 'expire'])) {
                $sponsorship->update(['status' => 'failed']);
                return redirect()->back()->with('success', 'Sync: Sponsorship gagal (' . $midtransStatus . ').');
            } else {
                return redirect()->back()->with('info', 'Sync: Status Midtrans = ' . $midtransStatus . ' (pending).');
            }
        }

        // Donasi
        $donation = Donation::where('order_id', $id)->first();
        if (!$donation) {
            return redirect()->back()->with('error', 'Data donasi tidak ditemukan.');
        }

        if (in_array($midtransStatus, ['settlement', 'capture'])) {
            $donation->update(['status' => 'success']);
            $donation->campaign?->increment('collected_amount', $donation->amount);

            if ($donation->donor_email) {
                try {
                    Mail::to($donation->donor_email)->send(new DonationSuccessMail($donation));
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Gagal kirim email donasi: ' . $e->getMessage());
                }
            }

            return redirect()->back()->with('success', 'Sync: Donasi sukses (settlement).');
        } elseif (in_array($midtransStatus, ['deny', 'cancel', 'expire'])) {
            $donation->update(['status' => 'failed']);
            return redirect()->back()->with('success', 'Sync: Donasi gagal (' . $midtransStatus . ').');
        } else {
            return redirect()->back()->with('info', 'Sync: Status Midtrans = ' . $midtransStatus . ' (pending).');
        }
    }

    // ── Private: kirim WA notifikasi sponsorship ──
    private function kirimWaSponsor(Sponsorship $sponsorship): void
    {
        $child   = $sponsorship->fosterChild;
        $fonnte  = new FonnteService();

        $namaAnak    = $child?->name        ?? 'anak asuh';
        $usiaAnak    = $child?->age         ? $child->age . ' tahun' : '-';
        $paket       = $sponsorship->package ?? '-';
        $nominal     = 'Rp ' . number_format($sponsorship->amount, 0, ',', '.');
        $mulai       = $sponsorship->starts_at
                         ? \Carbon\Carbon::parse($sponsorship->starts_at)->translatedFormat('d F Y')
                         : now()->translatedFormat('d F Y');
        $berakhir    = $sponsorship->expires_at
                         ? \Carbon\Carbon::parse($sponsorship->expires_at)->translatedFormat('d F Y')
                         : now()->addMonth()->translatedFormat('d F Y');
        $orderId     = $sponsorship->order_id;
        $donatur     = $sponsorship->donor_name;

        $pesan = "Assalamu'alaikum, *{$donatur}* 🌿\n\n"
               . "✅ *Sponsorship Anak Asuh Berhasil Dikonfirmasi!*\n\n"
               . "Terima kasih telah menjadi Orang Tua Asuh. Kepedulian Anda sangat berarti bagi masa depan anak-anak kami. 🤲\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "👦 *Data Anak Asuh*\n"
               . "Nama   : {$namaAnak}\n"
               . "Usia   : {$usiaAnak}\n\n"
               . "📦 *Rincian Paket*\n"
               . "Paket  : {$paket}\n"
               . "Nominal: {$nominal}\n"
               . "Berlaku: {$mulai} s/d {$berakhir}\n\n"
               . "🆔 *ID Transaksi*\n"
               . "{$orderId}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Semoga Allah SWT membalas kebaikan Anda dengan berlipat ganda. Aamiin 🤍\n\n"
               . "_Baitul Yatim_";

        $fonnte->send($sponsorship->donor_phone, $pesan);
    }
}