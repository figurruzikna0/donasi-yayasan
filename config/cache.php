<?php

/*
 * cache.php — Konfigurasi cache
 * ===============================
 * Cache = penyimpanan sementara data yang sering dipakai agar akses
 * lebih cepat tanpa membaca ulang dari sumber asli (misal database).
 * File ini mengatur:
 *  - default     → driver cache default yang dipakai
 *  - stores      → daftar "toko" cache (tempat penyimpanan data cache)
 *  - prefix      → awalan nama key cache (anti tabrakan antar aplikasi)
 *  - serializable_classes → keamanan: kelas yang boleh di-unserialize
 */

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    | Driver cache default yang dipakai framework bila tidak ada store
    | lain yang disebutkan eksplisit. Di sistem ini default = 'database'
    | (data cache disimpan di tabel 'cache' pada database).
    */

    'default' => env('CACHE_STORE', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    | Daftar semua "toko" cache beserta drivernya.
    | Bisa ada banyak store dengan driver berbeda untuk kelompok data berbeda.
    |
    | Driver yang didukung: "array", "database", "file", "memcached",
    |                       "redis", "dynamodb", "storage", "octane",
    |                       "session", "failover", "null"
    */

    'stores' => [

        // ARRAY — cache disimpan dalam array PHP.
        // Hanya bertahan selama satu request (untuk testing), tidak persist.
        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        // DATABASE — cache disimpan di tabel database (driver paling cocok
        // untuk hosting berbagi yang tidak punya Redis/Memcached).
        //  - connection  → koneksi DB khusus cache (kosong = ikut default)
        //  - table       → tabel penyimpanan cache (default 'cache')
        //  - lock_*      → koneksi/tabel khusus untuk cache locking (opsional)
        'database' => [
            'driver' => 'database',
            'connection' => env('DB_CACHE_CONNECTION'),
            'table' => env('DB_CACHE_TABLE', 'cache'),
            'lock_connection' => env('DB_CACHE_LOCK_CONNECTION'),
            'lock_table' => env('DB_CACHE_LOCK_TABLE'),
        ],

        // FILE — cache disimpan sebagai file di storage.
        //  - path      → lokasi file cache
        //  - lock_path → lokasi file untuk cache locking
        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
            'lock_path' => storage_path('framework/cache/data'),
        ],

        // STORAGE — cache disimpan memakai salah satu disk filesystem
        // (misal disk S3). path relatif ke root disk.
        'storage' => [
            'driver' => 'storage',
            'disk' => env('CACHE_STORAGE_DISK'),
            'path' => env('CACHE_STORAGE_PATH', 'framework/cache/data'),
        ],

        // MEMCACHED — cache disimpan di server Memcached (in-memory).
        //  - persistent_id → ID koneksi yang dipertahankan antar request
        //  - sasl          → autentikasi (username/password), opsional
        //  - servers       → daftar server memcached (host, port, weight)
        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Contoh opsi koneksi memcached (dikomentari karena opsional):
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,   // bobot prioritas server
                ],
            ],
        ],

        // REDIS — cache disimpan di Redis (in-memory key-value store).
        //  - connection     → koneksi redis yang dipakai (default 'cache')
        //  - lock_connection → koneksi untuk cache locking
        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_CACHE_CONNECTION', 'cache'),
            'lock_connection' => env('REDIS_CACHE_LOCK_CONNECTION', 'default'),
        ],

        // DYNAMODB — cache disimpan di AWS DynamoDB.
        // Butuh kredensial AWS (key, secret, region, tabel).
        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

        // OCTANE — cache yang terikat dengan proses Octane (Laravel Octane).
        'octane' => [
            'driver' => 'octane',
        ],

        // FAILOVER — mencoba beberapa store secara berurutan;
        // jika store pertama gagal, lanjut ke store berikutnya.
        'failover' => [
            'driver' => 'failover',
            'stores' => [
                'database',
                'array',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Prefix Key Cache (Cache Key Prefix)
    |--------------------------------------------------------------------------
    | Saat memakai cache bersama (database, memcached, Redis, DynamoDB),
    | bisa ada aplikasi lain memakai media yang sama. Karena itu setiap
    | key cache diberi AWALAN (prefix) agar tidak bertabrakan antar aplikasi.
    | Contoh hasil: laravel-cache- (slug dari APP_NAME).
    */

    'prefix' => env('CACHE_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-cache-'),

    /*
    |--------------------------------------------------------------------------
    | Kelas yang Boleh di-Unserialize (Serializable Classes)
    |--------------------------------------------------------------------------
    | Nilai ini menentukan kelas PHP yang boleh dibaca (unserialize)
    | dari penyimpanan cache. Default FALSE = tidak ada kelas yang diizinkan —
    | ini pengamanan dari serangan "gadget chain" bila APP_KEY bocor.
    */

    'serializable_classes' => false,

];