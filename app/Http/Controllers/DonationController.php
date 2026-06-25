<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use Midtrans\Config; // <-- Wajib ada buat Midtrans
use Midtrans\Snap;   // <-- Wajib ada buat Pop-up

class DonationController extends Controller
{
    public function create(Campaign $campaign)
    {
        return view('donations.create', compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        // 1. Validasi Baru: Cuma butuh Nama, Email, sama Nominal aja!
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1000',
        ]);

        // 2. Set Konfigurasi Midtrans dari file .env kita
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 3. Bikin Nomor Resi Unik (Wajib buat Midtrans)
        $orderId = 'DONASI-' . uniqid();

        // 4. Simpan data ke database (Status otomatis 'pending')
        $donation = Donation::create([
            'campaign_id' => $campaign->id,
            'order_id' => $orderId,
            'donor_name' => $validated['donor_name'],
            'donor_email' => $validated['donor_email'],
            'amount' => $validated['amount'],
            'status' => 'pending', 
        ]);

        // 5. Susun data yang mau dikirim ke server Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $donation->amount,
            ],
            'customer_details' => [
                'first_name' => $donation->donor_name,
                'email' => $donation->donor_email,
            ],
        ];

        // 6. Minta "Kunci Pop-up" (Snap Token) ke Midtrans
        $snapToken = Snap::getSnapToken($params);

        // 7. Simpan Token itu ke database
        $donation->update(['snap_token' => $snapToken]);

        // 8. Lempar donatur ke halaman pembayaran yang ada tombol hijaunya
        return view('donations.payment', compact('donation', 'campaign', 'snapToken'));
    }

    // --- TAMBAHAN BARU: TELINGA UNTUK MIDTRANS (WEBHOOK/CALLBACK) ---
    public function callback(Request $request)
    {
        // 1. Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        // 2. Tangkap laporan dari Midtrans
        $notification = new \Midtrans\Notification();

        $status = $notification->transaction_status;
        $orderId = $notification->order_id;

        // 3. Cari data donasi di database berdasarkan order_id
        $donation = Donation::where('order_id', $orderId)->first();

        if ($donation) {
            // 4. Ubah status sesuai laporan Midtrans
            if ($status == 'settlement' || $status == 'capture') {
                // Kalau sukses bayar
                $donation->update(['status' => 'success']);
                
                // Tambahin total uang terkumpul di Campaign
                $campaign = Campaign::find($donation->campaign_id);
                $campaign->increment('collected_amount', $donation->amount);

            } elseif ($status == 'pending') {
                $donation->update(['status' => 'pending']);
            } elseif ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
                $donation->update(['status' => 'failed']);
            }
        }

        // Beri jawaban ke Midtrans kalau laporan udah diterima
        return response()->json(['message' => 'Laporan diterima']);
    }
}