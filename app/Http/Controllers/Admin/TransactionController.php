<?php

/*
 * TransactionController (Admin) — Kelola Transaksi Donasi & Sponsorship
 * =======================================================================
 * Controller ADMIN untuk mengelola semua transaksi (donasi + sponsorship).
 *
 * Fitur:
 *   1. index()       → Daftar semua transaksi dengan statistik & pagination
 *   2. approve($id)  → Setujui transaksi: status → success, generate invoice_number,
 *                      increment campaign.collected_amount, kirim WA notifikasi
 *   3. reject()      → Tolak transaksi: status → failed, simpan rejection_reason, kirim WA
 *   4. destroy($id)  → Hapus data transaksi
 *   5. syncAll()     → [NONAKTIF] Sinkron massal status ke Midtrans (dikomentari — pembayaran manual)
 *   6. sync($id)     → [NONAKTIF] Sinkron satu transaksi ke Midtrans (dikomentari — pembayaran manual)
 *
 * Identifikasi jenis transaksi:
 *   - ORDER ID diawali "SPONSOR-" → sponsorship
 *   - ORDER ID diawali "DONASI-"  → donasi kampanye
 *
 * NOTIFIKASI WA:
 *   - kirimWaSponsor()   → WA pemberitahuan approve sponsorship
 *   - kirimWaDonasi()    → WA pemberitahuan approve donasi
 *   - kirimWaTolakSponsor() → WA pemberitahuan penolakan sponsorship
 *   - kirimWaTolakDonasi()   → WA pemberitahuan penolakan donasi
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Sponsorship;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Midtrans\Config;          // Midtrans NONAKTIF (pembayaran manual upload bukti)
// use Midtrans\Transaction;     // Midtrans NONAKTIF (pembayaran manual upload bukti)

class TransactionController extends Controller
{
    // --- DAFTAR TRANSAKSI ---
    public function index()
    {
        $donationCount = Donation::count();
        $sponsorshipCount = Sponsorship::count();
        $donationSuccessCount = Donation::where('status', 'success')->count();
        $donationPendingCount = Donation::where('status', 'pending')->count();
        $sponsorshipSuccessCount = Sponsorship::where('status', 'success')->count();
        $sponsorshipPendingCount = Sponsorship::where('status', 'pending')->count();

        $donations = Donation::with('campaign')->latest()->paginate(10)
            ->through(fn($item) => (object) [
                'order_id'       => $item->order_id,
                'donor_name'     => $item->donor_name,
                'donor_email'    => $item->donor_email,
                'amount'         => $item->amount,
                'target'         => $item->campaign->title ?? '-',
                'payment_method' => $item->payment_method,
                'payment_proof'  => $item->payment_proof,
                'status'         => $item->status,
                'created_at'     => $item->created_at,
            ]);

        $sponsorships = Sponsorship::with('fosterChild')->latest()->paginate(10, ['*'], 'sponsorships_page')
            ->through(fn($item) => (object) [
                'order_id'       => $item->order_id,
                'donor_name'     => $item->donor_name,
                'donor_email'    => $item->donor_email,
                'donor_phone'    => $item->donor_phone,
                'amount'         => $item->amount,
                'target'         => $item->fosterChild->name ?? '-',
                'package'        => $item->package,
                'payment_method' => $item->payment_method,
                'payment_proof'  => $item->payment_proof,
                'status'         => $item->status,
                'created_at'     => $item->created_at,
            ]);

        return view('admin.transactions.index', compact(
            'donations', 'sponsorships',
            'donationCount', 'sponsorshipCount',
            'donationSuccessCount', 'donationPendingCount',
            'sponsorshipSuccessCount', 'sponsorshipPendingCount',
        ));
    }

    // --- SETUJUI TRANSAKSI: update status sponsorship/donasi jadi success, kirim WA notifikasi, redirect back ---
    // Semua operasi database dibungkus DB::transaction agar atomik
    // (status berubah DAN dana bertambah bersama, atau dibatalkan bersama).
    // Notifikasi WA dikirim SETELAH transaksi commit — bukan operasi DB,
    // sehingga kegagalan kirim WA tidak mem-rollback data yang sudah benar.
    public function approve($id)
    {
        // ── Cek & update sponsorship ──
        if (str_starts_with($id, 'SPONSOR-')) {
            $sponsorship = DB::transaction(function () use ($id) {
                $sponsorship = Sponsorship::with('fosterChild')
                    ->where('order_id', $id)
                    ->first();

                if (!$sponsorship) {
                    return null;
                }

                $sponsorship->update([
                    'status'            => 'success',
                    'rejection_reason'  => null,
                    'starts_at'         => $sponsorship->starts_at  ?? now(),
                    'expires_at'        => $sponsorship->expires_at ?? now()->addMonth(),
                ]);

                $sponsorship->fosterChild?->update(['status' => 'Diasuh']);

                return $sponsorship;
            });

            if (!$sponsorship) {
                return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
            }

            if ($sponsorship->donor_phone) {
                $this->kirimWaSponsor($sponsorship);
            }

            return redirect()->back()->with('success', 'Sponsorship berhasil disetujui!');
        }

        // ── Cek & update donasi kampanye ──
        $donation = DB::transaction(function () use ($id) {
            $donation = Donation::where('order_id', $id)->first();

            if (!$donation) {
                return null;
            }

            // Generate invoice_number jika belum ada
            if (!$donation->invoice_number) {
                $month = now()->format('Ym');
                $count = Donation::where('status', 'success')
                    ->whereNotNull('invoice_number')
                    ->where('invoice_number', 'like', "INV-DN-{$month}-%")
                    ->count();
                $seq   = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
                $donation->invoice_number = "INV-DN-{$month}-{$seq}";
            }

            $donation->status = 'success';
            $donation->save();

            $donation->campaign?->increment('collected_amount', $donation->amount);

            return $donation;
        });

        if (!$donation) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        if ($donation->donor_phone) {
            $this->kirimWaDonasi($donation);
        }

        return redirect()->back()->with('success', 'Transaksi berhasil disetujui!');
    }

    // --- TOLAK TRANSAKSI: update status jadi failed, simpan alasan penolakan, kirim WA notifikasi ke donatur ---
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        if (str_starts_with($id, 'SPONSOR-')) {
            $sponsorship = DB::transaction(function () use ($id, $request) {
                $sponsorship = Sponsorship::with('fosterChild')
                    ->where('order_id', $id)
                    ->first();

                if (!$sponsorship) {
                    return null;
                }

                $sponsorship->update([
                    'status'            => 'failed',
                    'rejection_reason'  => $request->rejection_reason,
                ]);

                return $sponsorship;
            });

            if (!$sponsorship) {
                return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
            }

            if ($sponsorship->donor_phone) {
                $this->kirimWaTolakSponsor($sponsorship, $request->rejection_reason);
            }

            return redirect()->back()->with('success', 'Sponsorship ditolak. Notifikasi telah dikirim ke donatur.');
        }

        $donation = DB::transaction(function () use ($id, $request) {
            $donation = Donation::where('order_id', $id)->first();

            if (!$donation) {
                return null;
            }

            $donation->update([
                'status'            => 'failed',
                'rejection_reason'  => $request->rejection_reason,
            ]);

            return $donation;
        });

        if (!$donation) {
            return redirect()->back()->with('error', 'Data donasi tidak ditemukan.');
        }

        if ($donation->donor_phone) {
            $this->kirimWaTolakDonasi($donation, $request->rejection_reason);
        }

        return redirect()->back()->with('success', 'Donasi ditolak. Notifikasi telah dikirim ke donatur.');
    }

    // --- HAPUS TRANSAKSI: hapus data sponsorship/donasi berdasarkan order_id, redirect back ---
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

    // --- SINKRON SEMUA: [NONAKTIF] cek status semua transaksi pending ke Midtrans ---
    // Midtrans dinonaktifkan sementara (pembayaran pakai upload bukti transfer manual).
    // Untuk mengaktifkan kembali: hapus tanda komentar pada method ini, import Midtrans di atas,
    // serta route transactions.sync-all di routes/web.php, lalu pastikan .env berisi MIDTRANS_SERVER_KEY.
    public function syncAll()
    {
        return redirect()->back()->with('info', 'Fitur sinkronisasi Midtrans sedang nonaktif.');
    }

    // --- SINKRON SATU TRANSAKSI: [NONAKTIF] cek status order tertentu ke Midtrans ---
    // Midtrans dinonaktifkan sementara (pembayaran pakai upload bukti transfer manual).
    // Untuk mengaktifkan kembali: hapus tanda komentar pada method ini, import Midtrans di atas,
    // serta route transactions.sync di routes/web.php, lalu pastikan .env berisi MIDTRANS_SERVER_KEY.
    public function sync($id)
    {
        return redirect()->back()->with('info', 'Fitur sinkronisasi Midtrans sedang nonaktif.');
    }

    private function kirimWaTolakSponsor(Sponsorship $sponsorship, string $reason): void
    {
        $fonnte  = new FonnteService();
        $donatur = $sponsorship->donor_name;

        $pesan = "Assalamu'alaikum, *{$donatur}*\n\n"
               . "*Sponsorship Anak Asuh Ditolak*\n\n"
               . "Mohon maaf, pengajuan sponsorship anak asuh Anda belum dapat disetujui dengan alasan berikut:\n\n"
               . "*Alasan Penolakan:*\n{$reason}\n\n"
               . "Silakan hubungi admin yayasan untuk informasi lebih lanjut.\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "*ID Transaksi*\n{$sponsorship->order_id}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Wassalamu'alaikum wr. wb.\n"
               . "_Baitul Yatim_";

        $fonnte->send($sponsorship->donor_phone, $pesan);
    }

    private function kirimWaTolakDonasi(Donation $donation, string $reason): void
    {
        $fonnte  = new FonnteService();
        $donatur = $donation->donor_name;

        $pesan = "Assalamu'alaikum, *{$donatur}*\n\n"
               . "*Donasi Ditolak*\n\n"
               . "Mohon maaf, donasi Anda belum dapat disetujui dengan alasan berikut:\n\n"
               . "*Alasan Penolakan:*\n{$reason}\n\n"
               . "Silakan hubungi admin yayasan untuk informasi lebih lanjut.\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "*ID Transaksi*\n{$donation->order_id}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Wassalamu'alaikum wr. wb.\n"
               . "_Baitul Yatim_";

        $fonnte->send($donation->donor_phone, $pesan);
    }

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

        $pesan = "Assalamu'alaikum, *{$donatur}*\n\n"
               . "*Sponsorship Anak Asuh Berhasil Dikonfirmasi!*\n\n"
               . "Terima kasih telah menjadi Orang Tua Asuh. Kepedulian Anda sangat berarti bagi masa depan anak-anak kami.\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "*Data Anak Asuh*\n"
               . "Nama   : {$namaAnak}\n"
               . "Usia   : {$usiaAnak}\n\n"
               . "*Rincian Paket*\n"
               . "Paket  : {$paket}\n"
               . "Nominal: {$nominal}\n"
               . "Berlaku: {$mulai} s/d {$berakhir}\n\n"
               . "*ID Transaksi*\n"
               . "{$orderId}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Semoga Allah SWT membalas kebaikan Anda dengan berlipat ganda. Aamiin\n\n"
               . "_Baitul Yatim_";

        $fonnte->send($sponsorship->donor_phone, $pesan);
    }

    private function kirimWaDonasi(Donation $donation): void
    {
        $fonnte  = new FonnteService();

        $campaign = $donation->campaign;
        $judul    = $campaign ? $campaign->title : '-';
        $nominal  = 'Rp ' . number_format($donation->amount, 0, ',', '.');
        $tanggal  = $donation->created_at->translatedFormat('d F Y');
        $donatur  = $donation->donor_name;
        $metode   = $donation->payment_method ?? '-';

        $pesan = "Assalamu'alaikum, *{$donatur}*\n\n"
               . "*Donasi Berhasil Dikonfirmasi!*\n\n"
               . "Terima kasih atas donasi Anda. Semoga kebaikan ini menjadi amal jariyah yang tak terputus pahalanya.\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "*Detail Donasi*\n"
               . "Campaign : {$judul}\n"
               . "Nominal  : {$nominal}\n"
               . "Tanggal  : {$tanggal}\n"
               . "Metode   : {$metode}\n\n"
               . "*ID Transaksi*\n"
               . "{$donation->order_id}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Semoga Allah SWT menerima amal ibadah Anda dan membalasnya dengan berlipat ganda. Aamiin\n\n"
               . "_Baitul Yatim_";

        $fonnte->send($donation->donor_phone, $pesan);
    }
}
