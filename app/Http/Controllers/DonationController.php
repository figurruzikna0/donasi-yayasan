<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\FosterChild;
use Midtrans\Config; 
use Midtrans\Snap;

class DonationController extends Controller
{
    /**
     * Helper untuk memuat konfigurasi Midtrans agar tidak berulang-ulang.
     */
    private function initMidtrans()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function create(Campaign $campaign)
    {
        return view('donations.create', compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1000',
        ]);

        // Panggil fungsi konfigurasi
        $this->initMidtrans();

        $orderId = 'DONASI-' . uniqid();

        $donation = Donation::create([
            'campaign_id' => $campaign->id,
            'order_id' => $orderId,
            'donor_name' => $validated['donor_name'],
            'donor_email' => $validated['donor_email'],
            'amount' => $validated['amount'],
            'status' => 'pending', 
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $donation->amount,
            ],
            'customer_details' => [
                'first_name' => $donation->donor_name,
                'email' => $donation->donor_email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $donation->update(['snap_token' => $snapToken]);

        return view('donations.payment', compact('donation', 'campaign', 'snapToken'));
    }

    /**
     * Menampilkan form sponsor untuk foster child tertentu.
     */
    public function sponsorForm($id)
    {
        $child = FosterChild::findOrFail($id);

        return view('donations.sponsor', compact('child'));
    }

    /**
     * Memproses form sponsor & generate Snap token Midtrans.
     */
    public function sponsorStore(Request $request, $id)
    {
        $child = FosterChild::findOrFail($id);

        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1000',
            'paket_komitmen' => 'required|string|max:255',
            'description' => 'nullable|string',
            'payment_method' => 'nullable|string|max:255',
        ]);

        $this->initMidtrans();

        $orderId = 'SPONSOR-' . uniqid();

        $sponsorship = Sponsorship::create([
            'foster_child_id' => $child->id,
            'order_id' => $orderId,
            'donor_name' => $validated['donor_name'],
            'donor_email' => $validated['donor_email'],
            'amount' => $validated['amount'],
            'package' => $validated['paket_komitmen'],
            'package_description' => $validated['description'] ?? null,
            'payment_method' => $validated['payment_method'] ?? null,
            'status' => 'pending',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $sponsorship->amount,
            ],
            'customer_details' => [
                'first_name' => $sponsorship->donor_name,
                'email' => $sponsorship->donor_email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $sponsorship->update(['snap_token' => $snapToken]);

        return view('donations.sponsor_payment', compact('sponsorship', 'child', 'snapToken'));
    }

    public function callback(Request $request)
    {
        // Panggil fungsi konfigurasi
        $this->initMidtrans();

        $notification = new \Midtrans\Notification();
        $status = $notification->transaction_status;
        $orderId = $notification->order_id;

        if (str_starts_with($orderId, 'SPONSOR-')) {
            $sponsorship = Sponsorship::where('order_id', $orderId)->first();

            if ($sponsorship) {
                if (in_array($status, ['settlement', 'capture'])) {
                    $sponsorship->update(['status' => 'success']);

                    // Tandai anak sudah diasuh
                    $child = FosterChild::find($sponsorship->foster_child_id);
                    if ($child) {
                        $child->update(['status' => 'Diasuh']);
                    }
                } elseif ($status == 'pending') {
                    $sponsorship->update(['status' => 'pending']);
                } else {
                    $sponsorship->update(['status' => 'failed']);
                }
            }
        } else {
            $donation = Donation::where('order_id', $orderId)->first();

            if ($donation) {
                if (in_array($status, ['settlement', 'capture'])) {
                    $donation->update(['status' => 'success']);

                    // Update total dana di campaign
                    $campaign = Campaign::find($donation->campaign_id);
                    if ($campaign) {
                        $campaign->increment('collected_amount', $donation->amount);
                    }
                } elseif ($status == 'pending') {
                    $donation->update(['status' => 'pending']);
                } else {
                    $donation->update(['status' => 'failed']);
                }
            }
        }

        return response()->json(['message' => 'Laporan diterima']);
    }
}