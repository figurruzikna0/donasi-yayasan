<?php

/*
 * services.php — Konfigurasi layanan pihak ketiga
 * =================================================
 * File ini menyimpan KREDENSIAL layanan eksternal yang dipakai aplikasi.
 * Nilai kredensial selalu diambil dari .env (jangan pernah hardcode).
 *
 * Konteks sistem ini:
 *  - 'fonnte' → gateway WhatsApp (PALING DIPAKAI — notifikasi donatur,
 *    reminder perpanjangan, laporan perkembangan, dll.)
 *  - lainnya (postmark, resend, ses, slack) → konfigurasi bawaan, tidak aktif.
 *
 * Cara akses dari kode: config('services.fonnte.token')
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services (Layanan Pihak Ketiga)
    |--------------------------------------------------------------------------
    | Tempat penyimpanan kredensial layanan eksternal seperti Mailgun,
    | Postmark, AWS, dll. Lokasi ini konvensional — semua package
    | bisa mengambil kredensialnya di sini.
    */

    // ── FONNTE (WhatsApp Gateway) — layanan paling penting sistem ini ──
    // Token API Fonnte. Dikirim sebagai header 'Authorization' saat
    // memanggil endpoint https://api.fonnte.com/send (lihat FonnteService).
    'fonnte' => [
        'token' => env('FONNTE_TOKEN'),
    ],

    // ── POSTMARK (email cloud) — tidak dipakai, hanya cadangan ──
    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    // ── RESEND (email cloud) — tidak dipakai, hanya cadangan ──
    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    // ── SES (Amazon email) — tidak dipakai, hanya cadangan ──
    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // ── SLACK (notifikasi) — tidak dipakai, hanya cadangan ──
    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];