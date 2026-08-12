<?php

/*
 * mail.php — Konfigurasi email
 * ==============================
 * File ini mengatur PENGIRIMAN EMAIL aplikasi:
 *  - default → mailer default yang dipakai
 *  - mailers → daftar mailer (sarana pengiriman email) yang tersedia
 *  - from    → alamat pengirim global untuk semua email
 *
 * Catatan sistem: aplikasi ini lebih banyak memakai WhatsApp (Fonnte)
 * daripada email, sehingga mailer default 'log' (email "dikirim" ke file log).
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    | Mailer yang dipakai mengirim semua email bila tidak ada mailer lain
    | yang disebutkan eksplisit. Di sini default 'log' (email ditulis ke log,
    | tidak benar-benar terkirim — cocok saat pengembangan).
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    | Daftar mailer beserta pengaturannya. Bisa menambah mailer sendiri
    | sesuai kebutuhan aplikasi.
    |
    | Transport yang didukung: "smtp", "sendmail", "mailgun", "ses",
    |   "ses-v2", "postmark", "resend", "log", "array", "failover", "roundrobin"
    */

    'mailers' => [

        // SMTP — kirim email lewat server SMTP standar.
        //  - host / port   → server SMTP (default 127.0.0.1:2525 = Mailpit lokal)
        //  - username / password → kredensial akun SMTP
        //  - encryption    → 'tls' atau 'ssl' untuk koneksi aman
        //  - local_domain  → domain EHLO (diambil dari host APP_URL)
        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        // SES — email via Amazon SES (cloud). Kredensial di config/services.php.
        'ses' => [
            'transport' => 'ses',
        ],

        // POSTMARK — email via Postmark (cloud).
        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        // RESEND — email via Resend (cloud).
        'resend' => [
            'transport' => 'resend',
        ],

        // SENDMAIL — pakai binary sendmail di server (Linux).
        //  - path → lokasi binary sendmail
        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        // LOG — email TIDAK dikirim sungguhan, hanya ditulis ke channel log.
        // Sangat berguna di lingkungan pengembangan.
        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        // ARRAY — email disimpan dalam array PHP (untuk testing).
        'array' => [
            'transport' => 'array',
        ],

        // FAILOVER — coba mailer pertama; BILA GAGAL, coba mailer berikutnya.
        // retry_after = jeda detik sebelum percobaan ulang.
        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        // ROUNDROBIN — gilir-giliran memakai mailer di daftar secara merata.
        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Alamat Pengirim Global ("From" Address)
    |--------------------------------------------------------------------------
    | Nama & alamat yang dipakai sebagai PENGIRIM semua email bila email
    | tidak menentukan alamat From sendiri.
    |  - address → alamat email pengirim (default hello@example.com)
    |  - name    → nama pengirim (default nama aplikasi)
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', env('APP_NAME', 'Laravel')),
    ],

];