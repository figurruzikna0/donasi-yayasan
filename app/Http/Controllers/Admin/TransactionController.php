<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Donation::with('campaign')->latest()->get()->map(function ($item) {
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

        return view('admin.transactions.index', compact('transactions'));
    }

    public function destroy($id)
    {
        $donation = Donation::where('order_id', $id)->first();

        if (! $donation) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        $donation->delete();

        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus dari sistem!');
    }

    public function approve($id)
    {
        $donation = Donation::where('order_id', $id)->first();

        if (! $donation) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        $donation->update(['status' => 'success']);
        $donation->campaign?->increment('collected_amount', $donation->amount);

        return redirect()->back()->with('success', 'Transaksi berhasil disetujui!');
    }
}