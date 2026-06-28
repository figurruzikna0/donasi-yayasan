<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $donations = Donation::with('campaign')->latest()->get()->map(function ($item) {
            return (object) [
                'order_id' => $item->order_id,
                'donor_name' => $item->donor_name,
                'donor_email' => $item->donor_email,
                'amount' => $item->amount,
                'target' => $item->campaign->title ?? '-',
                'payment_method' => $item->payment_method,
                'status' => $item->status,
                'created_at' => $item->created_at,
            ];
        });

        $sponsorships = Sponsorship::with('fosterChild')->latest()->get()->map(function ($item) {
            return (object) [
                'order_id' => $item->order_id,
                'donor_name' => $item->donor_name,
                'donor_email' => $item->donor_email,
                'donor_phone' => $item->donor_phone,
                'amount' => $item->amount,
                'target' => $item->fosterChild->name ?? '-',
                'package' => $item->package,
                'payment_method' => $item->payment_method,
                'status' => $item->status,
                'created_at' => $item->created_at,
            ];
        });

        return view('admin.transactions.index', compact('donations', 'sponsorships'));
    }

    public function approve($id)
    {
        if (str_starts_with($id, 'SPONSOR-')) {
            $sponsorship = Sponsorship::where('order_id', $id)->first();

            if (! $sponsorship) {
                return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
            }

            $sponsorship->update([
                'status' => 'success',
                'starts_at' => $sponsorship->starts_at ?? now(),
                'expires_at' => $sponsorship->expires_at ?? now()->addMonth(),
            ]);

            $sponsorship->fosterChild?->update(['status' => 'Diasuh']);

            return redirect()->back()->with('success', 'Sponsorship berhasil disetujui!');
        }

        $donation = Donation::where('order_id', $id)->first();

        if (! $donation) {
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

            if (! $sponsorship) {
                return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
            }

            $sponsorship->delete();

            return redirect()->back()->with('success', 'Data sponsorship berhasil dihapus!');
        }

        $donation = Donation::where('order_id', $id)->first();

        if (! $donation) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        $donation->delete();

        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus dari sistem!');
    }
}