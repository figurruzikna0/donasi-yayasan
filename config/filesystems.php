<?php

/*
 * filesystems.php — Konfigurasi filesystem
 * ==========================================
 * File ini mengatur tempat penyimpanan FILE aplikasi:
 *  - default → disk filesystem default yang dipakai
 *  - disks   → daftar disk (lokasi penyimpanan) yang tersedia
 *  - links   → daftar symbolic link yang dibuat perintah `php artisan storage:link`
 *
 * Konteks sistem ini: semua foto/bukti transfer disimpan di disk 'public'
 * (storage/app/public), lalu diakses publik lewat folder public/storage.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Disk Filesystem Default
    |--------------------------------------------------------------------------
    | Disk yang dipakai framework bila tidak ada disk lain yang disebutkan.
    | Di sini default 'local' (storage/app/private).
    | Namun di sistem ini, upload umumnya memakai disk 'public' secara eksplisit.
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    | Daftar "disk" penyimpanan yang tersedia. Bisa memakai driver yang sama
    | dengan root berbeda, atau driver cloud (S3).
    |
    | Driver yang didukung: "local", "ftp", "sftp", "s3"
    */

    'disks' => [

        // LOCAL — penyimpanan PRIVAT (tidak bisa diakses publik).
        // Root: storage/app/private. Untuk file internal aplikasi.
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,      // izinkan Laravel menyajikan file ini bila perlu
            'throw' => false,     // false = error operasi file tidak dilempar sebagai exception
            'report' => false,    // false = error tidak dilaporkan ke error handler
        ],

        // PUBLIC — penyimpanan PUBLIK (bisa diakses lewat URL /storage/...).
        // Root: storage/app/public.
        // URL: APP_URL + '/storage' (contoh: https://site.com/storage).
        // Inilah disk yang dipakai upload foto anak, bukti transfer, dll.
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
            'visibility' => 'public',   // file yang disimpan otomatis berstatus publik
            'throw' => false,
            'report' => false,
        ],

        // S3 — penyimpanan cloud Amazon S3 (opsional, tidak dipakai sistem).
        // Butuh kredensial AWS (key, secret, region, bucket).
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    | Daftar symbolic link yang dibuat saat menjalankan perintah:
    |   php artisan storage:link
    | Format: 'lokasi_link' => 'target'.
    | Di sini: folder public/storage → storage/app/public.
    | Artinya file upload bisa diakses publik lewat URL /storage/nama_file.jpg.
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];