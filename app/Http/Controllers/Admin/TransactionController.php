<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan halaman daftar transaksi (donasi kampanye + sponsorship anak asuh)
    public function index()
    {
        // Ambil data donasi kampanye, ubah jadi format seragam
        $donations = Donation::with('campaign')->latest()->get()->map(function ($item) {
            return (object) [
                'order_id' => $item->order_id,
                'type' => 'donation',
                'donor_name' => $item->donor_name,
                'donor_email' => $item->donor_email,
                'amount' => $item->amount,
                'target' => $item->campaign->title ?? '-',
                'package' => null,
                'payment_method' => null,
                'status' => $item->status,
                'created_at' => $item->created_at,
            ];
        });

        // Ambil data sponsorship anak asuh, ubah jadi format seragam
        $sponsorships = Sponsorship::with('fosterChild')->latest()->get()->map(function ($item) {
            return (object) [
                'order_id' => $item->order_id,
                'type' => 'sponsorship',
                'donor_name' => $item->donor_name,
                'donor_email' => $item->donor_email,
                'amount' => $item->amount,
                'target' => $item->fosterChild->name ?? '-',
                'package' => $item->package,
                'payment_method' => $item->payment_method,
                'status' => $item->status,
                'created_at' => $item->created_at,
            ];
        });

        // Gabung dua koleksi, urutkan dari yang terbaru
        $transactions = $donations->merge($sponsorships)->sortByDesc('created_at')->values();

        return view('admin.transactions.index', compact('transactions'));
    }

    // Hapus data transaksi (donasi atau sponsorship), dicari lewat order_id
    public function destroy($id)
    {
        $transaction = $this->findByOrderId($id);

        if (! $transaction) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        $transaction->delete();

        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus dari sistem!');
    }

    // Setujui transaksi secara manual
    public function approve($id)
    {
        $transaction = $this->findByOrderId($id);

        if (! $transaction) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        $transaction->update(['status' => 'success']);

        if ($transaction instanceof Sponsorship) {
            $transaction->fosterChild?->update(['status' => 'Diasuh']);
        }

        if ($transaction instanceof Donation) {
            $transaction->campaign?->increment('collected_amount', $transaction->amount);
        }

        return redirect()->back()->with('success', 'Transaksi berhasil disetujui!');
    }

    /**
     * Cari transaksi (Donation atau Sponsorship) berdasarkan order_id,
     * dibedakan lewat prefix "DONASI-" / "SPONSOR-".
     */
    private function findByOrderId($orderId)
    {
        if (str_starts_with($orderId, 'SPONSOR-')) {
            return Sponsorship::where('order_id', $orderId)->first();
        }

        return Donation::where('order_id', $orderId)->first();
    }
}