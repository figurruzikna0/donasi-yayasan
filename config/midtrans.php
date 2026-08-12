<?php

/*
 * midtrans.php — Konfigurasi Midtrans
 * =====================================
 * File konfigurasi payment gateway Midtrans (Snap).
 *
 * PENTING UNTUK PEMAHAMAN:
 * Sistem ini SEKARANG memakai pembayaran MANUAL (upload bukti transfer),
 * bukan Snap Midtrans. Namun konfigurasi ini tetap dipertahankan karena:
 *  - kode sync status transaksi (TransactionController) masih ada
 *  - kalau diaktifkan nanti, tinggal isi nilai di .env
 *
 * Cara akses dari kode: config('midtrans.server_key') dll.
 * (dipakai di TransactionController lewat Config::$serverKey).
 */

return [
    // ID merchant akun Midtrans Anda (terlihat di dashboard Midtrans)
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),

    // Client key — kunci publik, aman dipakai di sisi frontend/JS
    'client_key' => env('MIDTRANS_CLIENT_KEY'),

    // Server key — kunci rahasia (SERVER-SIDE ONLY, jangan bocorkan ke frontend)
    'server_key' => env('MIDTRANS_SERVER_KEY'),

    // false = sandbox (mode uji coba, tidak memotong uang asli)
    // true  = produksi (transaksi sungguhan)
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    // Sanitasi data sebelum dikirim ke Midtrans (hindari data mencurigakan)
    'is_sanitized' => true,

    // Aktifkan 3DS — lapisan verifikasi tambahan bank saat pembayaran
    // (mengurangi risiko transaksi ditolak/fraud)
    'is_3ds' => true,
];