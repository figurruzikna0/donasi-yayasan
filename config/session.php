<?php

/*
 * session.php — Konfigurasi session
 * ===================================
 * Session = cara aplikasi mengingat status pengguna antar request
 * (misal: status login, data sementara, dll.) melalui cookie + penyimpanan.
 * File ini mengatur:
 *  - driver session (di mana data session disimpan)
 *  - masa berlaku & perilaku cookie session
 *  - pengaturan keamanan cookie (secure, http_only, same_site)
 *  - serialisasi data session
 *
 * Di sistem ini: driver 'database' → session disimpan di tabel 'sessions'.
 */

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    | Tempat penyimpanan data session. 'database' adalah pilihan default
    | yang baik (data tersimpan di tabel sessions, tahan restart server).
    |
    | Driver didukung: "file", "cookie", "database", "memcached",
    |                  "redis", "dynamodb", "array"
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Masa Berlaku Session (Session Lifetime)
    |--------------------------------------------------------------------------
    | Berapa MENIT session boleh menganggur (idle) sebelum dianggap
    | kadaluarsa. Default 120 menit.
    |  - lifetime         → 120 menit idle
    |  - expire_on_close  → true = session langsung hilang saat browser ditutup
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Enkripsi Session (Session Encryption)
    |--------------------------------------------------------------------------
    | true = semua data session DIENKRIPSI sebelum disimpan.
    | Enkripsi dilakukan otomatis oleh Laravel; pemakaian session
    | tidak berubah dari sisi kode aplikasi.
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Lokasi File Session
    |--------------------------------------------------------------------------
    | Saat driver 'file' dipakai, file session diletakkan di sini
    | (storage/framework/sessions).
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Koneksi Database Session
    |--------------------------------------------------------------------------
    | Saat driver 'database' atau 'redis', tentukan koneksi yang dipakai
    | untuk mengelola session. Kosong = ikut koneksi database default.
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Tabel Database Session
    |--------------------------------------------------------------------------
    | Saat driver 'database', session disimpan pada tabel ini
    | (default 'sessions' — migrasi users membuatinya otomatis).
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Cache Store Session
    |--------------------------------------------------------------------------
    | Bila memakai backend session berbasis cache (dynamodb, memcached,
    | redis), tentukan store cache yang dipakai. Harus cocok dengan
    | salah satu store di config/cache.php.
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Session Sweeping Lottery
    |--------------------------------------------------------------------------
    | Beberapa driver session harus "menyapu" file/record session lama
    | secara manual. Lottery = peluang pembersihan per request.
    | [2, 100] = peluang 2 dari 100 request dilakukan pembersihan.
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nama Cookie Session
    |--------------------------------------------------------------------------
    | Nama cookie session yang dibuat framework. Umumnya TIDAK perlu diubah
    | (mengubahnya tidak memberi manfaat keamanan berarti).
    | Nama otomatis: {slug APP_NAME}-session
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Path Cookie Session
    |--------------------------------------------------------------------------
    | Path di mana cookie session dianggap tersedia.
    | '/' = tersedia di seluruh domain aplikasi.
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Domain Cookie Session
    |--------------------------------------------------------------------------
    | Domain dan subdomain tempat cookie session tersedia.
    | Default kosong = cookie hanya berlaku di domain utama tanpa subdomain.
    | Umumnya tidak perlu diubah.
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Hanya HTTPS (secure)
    |--------------------------------------------------------------------------
    | true = cookie session HANYA dikirim saat koneksi HTTPS.
    | Mencegah cookie bocor lewat HTTP biasa. Untuk produksi sebaiknya true.
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Only
    |--------------------------------------------------------------------------
    | true = JavaScript TIDAK bisa mengakses nilai cookie — cookie hanya
    | bisa dibaca lewat protokol HTTP. Melindungi dari serangan XSS.
    | Sangat disarankan tetap true.
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Same-Site Cookies
    |--------------------------------------------------------------------------
    | Menentukan perilaku cookie pada request lintas situs; berguna
    | mengurangi risiko serangan CSRF.
    |  - 'lax'   → cookie terkirim pada navigasi biasa lintas situs (default)
    |  - 'strict'→ cookie hanya terkirim ke situs asalnya sendiri
    |  - 'none'  → cookie selalu terkirim (harus disertai flag secure)
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Partitioned Cookies
    |--------------------------------------------------------------------------
    | true = cookie dikaitkan ke situs top-level untuk konteks lintas situs
    | (CHIPS). Hanya diterima browser bila cookie ber-flag 'secure'
    | dan Same-Site diatur 'none'.
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

    /*
    |--------------------------------------------------------------------------
    | Serialisasi Session
    |--------------------------------------------------------------------------
    | Strategi serialisasi data session.
    |  - 'json' → data disimpan sebagai JSON (default, lebih aman)
    |  - 'php'  → bisa menyimpan objek PHP, tapi rentan terhadap serangan
    |    "gadget chain" bila APP_KEY bocor. Jangan pakai kecuali perlu.
    */

    'serialization' => 'json',

];