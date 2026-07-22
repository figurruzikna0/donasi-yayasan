<?php
// === TransactionController (Admin): mengelola dan mensinkronkan transaksi donasi & sponsorship ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Sponsorship;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Transaction;

class TransactionController extends Controller
{
    // --- DAFTAR TRANSAKSI: menampilkan statistik & daftar donasi dan sponsorship dengan pagination ---
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
    public function approve($id)
    {
        // ── Cek & update sponsorship ──
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

            if ($sponsorship->donor_phone) {
                $this->kirimWaSponsor($sponsorship);
            }

            return redirect()->back()->with('success', 'Sponsorship berhasil disetujui!');
        }

        // ── Cek & update donasi kampanye ──
        $donation = Donation::where('order_id', $id)->first();

        if (!$donation) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        $donation->update(['status' => 'success']);
        $donation->campaign?->increment('collected_amount', $donation->amount);

        return redirect()->back()->with('success', 'Transaksi berhasil disetujui!');
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

    // --- SINKRON SEMUA: cek status semua transaksi pending ke Midtrans, update status otomatis, redirect back dengan ringkasan ---
    public function syncAll()
    {
        $results = ['success' => 0, 'failed' => 0, 'pending' => 0, 'errors' => 0];

        $orderIds = Donation::where('status', 'pending')
            ->whereNotNull('snap_token')
            ->pluck('order_id')
            ->concat(
                Sponsorship::where('status', 'pending')
                    ->whereNotNull('snap_token')
                    ->pluck('order_id')
            );

        if ($orderIds->isEmpty()) {
            return redirect()->back()->with('info', 'Tidak ada transaksi pending yang perlu disinkronkan.');
        }

        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        foreach ($orderIds as $orderId) {
            try {
                $status = Transaction::status($orderId);
            } catch (\Throwable $e) {
                $results['errors']++;
                continue;
            }

            $midtransStatus = $status->transaction_status ?? '';

            if (str_starts_with($orderId, 'SPONSOR-')) {
                $sponsorship = Sponsorship::where('order_id', $orderId)->first();
                if (!$sponsorship) continue;

                if (in_array($midtransStatus, ['settlement', 'capture'])) {
                    $sponsorship->update([
                        'status'     => 'success',
                        'starts_at'  => $sponsorship->starts_at ?? now(),
                        'expires_at' => $sponsorship->expires_at ?? now()->addMonth(),
                    ]);
                    $sponsorship->fosterChild?->update(['status' => 'Diasuh']);

                    $results['success']++;
                } elseif (in_array($midtransStatus, ['deny', 'cancel', 'expire'])) {
                    $sponsorship->update(['status' => 'failed']);
                    $results['failed']++;
                } else {
                    $results['pending']++;
                }
            } else {
                $donation = Donation::where('order_id', $orderId)->first();
                if (!$donation) continue;

                if (in_array($midtransStatus, ['settlement', 'capture'])) {
                    $donation->update(['status' => 'success']);
                    $donation->campaign?->increment('collected_amount', $donation->amount);

                    $results['success']++;
                } elseif (in_array($midtransStatus, ['deny', 'cancel', 'expire'])) {
                    $donation->update(['status' => 'failed']);
                    $results['failed']++;
                } else {
                    $results['pending']++;
                }
            }
        }

        $msg = '';
        if ($results['success'] > 0) {
            $msg .= "{$results['success']} transaksi berhasil dikonfirmasi. ";
        }
        if ($results['failed'] > 0) {
            $msg .= "{$results['failed']} transaksi gagal. ";
        }
        if ($results['pending'] > 0) {
            $msg .= "{$results['pending']} transaksi masih menunggu pembayaran. ";
        }
        if ($results['errors'] > 0) {
            $msg .= "{$results['errors']} transaksi gagal dihubungi ke Midtrans. ";
        }

        $msg = trim($msg) ?: 'Tidak ada perubahan status.';

        $redirect = redirect()->back();

        if ($results['success'] > 0) {
            $redirect->with('success', $msg);
        }
        if ($results['failed'] > 0) {
            $redirect->with('warning', $msg);
        }
        if ($results['pending'] > 0 && $results['success'] === 0) {
            $redirect->with('info', $msg);
        }
        if ($results['errors'] > 0 && $results['success'] === 0 && $results['failed'] === 0) {
            $redirect->with('error', $msg);
        }

        return $redirect;
    }

    // --- SINKRON SATU TRANSAKSI: cek status order tertentu ke Midtrans, update status, redirect back ---
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

                return redirect()->back()->with('success', 'Sync: Sponsorship sukses (settlement).');
            } elseif (in_array($midtransStatus, ['deny', 'cancel', 'expire'])) {
                $sponsorship->update(['status' => 'failed']);
                return redirect()->back()->with('success', 'Sync: Sponsorship gagal (' . $midtransStatus . ').');
            } else {
                return redirect()->back()->with('info', 'Sync: Status Midtrans = ' . $midtransStatus . ' (pending).');
            }
        }

        // Deteksi jenis: donasi atau sponsorship
        $donation = Donation::where('order_id', $id)->first();
        if (!$donation) {
            return redirect()->back()->with('error', 'Data donasi tidak ditemukan.');
        }

        if (in_array($midtransStatus, ['settlement', 'capture'])) {
            $donation->update(['status' => 'success']);
            $donation->campaign?->increment('collected_amount', $donation->amount);

            return redirect()->back()->with('success', 'Sync: Donasi sukses (settlement).');
        } elseif (in_array($midtransStatus, ['deny', 'cancel', 'expire'])) {
            $donation->update(['status' => 'failed']);
            return redirect()->back()->with('success', 'Sync: Donasi gagal (' . $midtransStatus . ').');
        } else {
            return redirect()->back()->with('info', 'Sync: Status Midtrans = ' . $midtransStatus . ' (pending).');
        }
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
