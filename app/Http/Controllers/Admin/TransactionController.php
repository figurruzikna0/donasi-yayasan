<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Sponsorship;
use App\Services\FonnteService;
use Illuminate\Http\Request;

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

            return redirect()->back()->with('success', 'Sponsorship berhasil disetujui!');
        }

        // ── Donasi kampanye ──
        $donation = Donation::where('order_id', $id)->first();

        if (!$donation) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        $donation->update(['status' => 'success']);
        $donation->campaign?->increment('collected_amount', $donation->amount);

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