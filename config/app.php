<?php

/*
 * app.php — Konfigurasi utama aplikasi
 * ======================================
 * File ini mengembalikan ARRAY konfigurasi yang dibaca Laravel melalui
 * config('app.nama_key'). Nilai-nilainya diambil dari file .env
 * (fungsi env('NAMA_VARIABEL', 'nilai_default')).
 *
 * Isi inti:
 *  - nama aplikasi (APP_NAME)
 *  - environment / lingkungan aplikasi (development / production)
 *  - mode debug (tampilkan detail error atau tidak)
 *  - URL aplikasi
 *  - timezone (zona waktu) — dipakai fungsi date PHP
 *  - kunci enkripsi (APP_KEY)
 *  - mode maintenance (perawatan aplikasi)
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Nama Aplikasi (Application Name)
    |--------------------------------------------------------------------------
    | Nama ini dipakai framework saat perlu menampilkan nama aplikasi,
    | misalnya pada notifikasi email atau elemen UI lain.
    | Diambil dari APP_NAME di .env, default-nya 'Laravel'.
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Environment / Lingkungan Aplikasi
    |--------------------------------------------------------------------------
    | Menentukan "lingkungan" tempat aplikasi berjalan, misalnya:
    |  - local  → pengembangan di komputer sendiri
    |  - production → server/hosting asli
    | Nilainya diset di file .env melalui APP_ENV.
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Mode Debug (Application Debug Mode)
    |--------------------------------------------------------------------------
    | - Jika TRUE: setiap error menampilkan pesan detail + stack trace
    |   (berbahaya di production karena bisa membocorkan informasi).
    | - Jika FALSE: hanya halaman error generik yang ditampilkan.
    | Dipaksa ke tipe boolean via (bool).
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL Aplikasi
    |--------------------------------------------------------------------------
    | URL dasar aplikasi. Dipakai oleh Artisan (CLI) saat membuat URL
    | yang benar, misalnya untuk link di email atau notifikasi.
    | Sebaiknya diisi dengan domain root aplikasi.
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Timezone / Zona Waktu
    |--------------------------------------------------------------------------
    | Zona waktu default untuk aplikasi yang dipakai fungsi date dan
    | date-time PHP (termasuk atribut created_at/updated_at Eloquent).
    | Sistem ini memakai 'Asia/Jakarta' (WIB) — sudah dikustomisasi
    | dari default bawaan Laravel yang 'UTC'.
    */

    'timezone' => 'Asia/Jakarta',

    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Locale / Bahasa
    |--------------------------------------------------------------------------
    | Locale default menentukan bahasa yang dipakai Laravel untuk
    | terjemahan (translation). Bisa diubah sesuai kebutuhan.
    |  - locale          → bahasa utama aplikasi (default 'en')
    |  - fallback_locale → bahasa cadangan bila terjemahan tidak ditemukan
    |  - faker_locale    → bahasa data dummy (untuk seeding/tes)
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Kunci Enkripsi (Encryption Key)
    |--------------------------------------------------------------------------
    | Kunci ini dipakai layanan enkripsi Laravel dan HARUS berupa
    | 32 karakter acak agar semua nilai terenkripsi aman.
    |  - cipher        → algoritma enkripsi yang dipakai (AES-256-CBC)
    |  - key           → kunci utama, DIBUAT saat install via `php artisan key:generate`
    |  - previous_keys → daftar kunci lama (untuk rotasi kunci).
    |    Dipecah dari APP_PREVIOUS_KEYS (format dipisah koma),
    |    lalu array_filter menghapus elemen kosong dari hasil explode.
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    // previous_keys: rotasi kunci — aplikasi masih bisa membaca data
    // yang dienkripsi dengan kunci lama selama kunci lama ada di daftar ini.
    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Driver Mode Maintenance
    |--------------------------------------------------------------------------
    | Menentukan cara Laravel menyimpan status "maintenance mode"
    | (saat aplikasi ditutup sementara untuk perawatan).
    |  - driver: 'file'   → status disimpan sebagai file
    |           'cache'   → status dikelola lewat cache (bisa lintas server)
    |  - store:  penyimpanan yang dipakai bila driver = cache
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];