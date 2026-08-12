<?php

/*
 * database.php — Konfigurasi database
 * =====================================
 * File ini mengatur:
 *  - default      → koneksi database default yang dipakai aplikasi
 *  - connections  → definisi koneksi per driver (sqlite, mysql, mariadb,
 *                   pgsql, sqlsrv) beserta kredensialnya
 *  - migrations   → tabel tempat Laravel mencatat migrasi yang sudah jalan
 *  - redis        → koneksi Redis (untuk cache/queue bila dipakai)
 */

use Illuminate\Support\Str;
use Pdo\Mysql;

return [

    /*
    |--------------------------------------------------------------------------
    | Nama Koneksi Database Default
    |--------------------------------------------------------------------------
    | Koneksi mana yang dipakai untuk semua operasi database bila tidak
    | ada koneksi lain yang disebutkan eksplisit. Nilai dari DB_CONNECTION
    | di .env — di sistem ini default 'sqlite' untuk lokal, tapi server
    | produksi memakai 'mysql' (hosting).
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    | Definisi semua koneksi database yang tersedia. Setiap driver
    | punya contoh konfigurasi lengkap. Silakan tambah/hapus sesuai kebutuhan.
    */

    'connections' => [

        // ── SQLITE (file database lokal, tanpa server) ─────────────
        // Cocok untuk pengembangan lokal & testing.
        //  - database   → path file .sqlite (default: database/database.sqlite)
        //  - prefix     → awalan nama tabel (kosong = tidak dipakai)
        //  - foreign_key_constraints → aktifkan penegakan foreign key
        //  - busy_timeout / journal_mode / synchronous / transaction_mode
        //    → tuning internal SQLite (null = pakai bawaan)
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
            'transaction_mode' => 'DEFERRED',
        ],

        // ── MYSQL (server MySQL — dipakai di hosting produksi) ─────
        //  - host / port → alamat server database (default 127.0.0.1:3306)
        //  - database    → nama database
        //  - username / password → kredensial login
        //  - unix_socket → socket lokal (opsional)
        //  - charset / collation → utf8mb4 = dukungan emoji & karakter penuh
        //  - strict      → mode query ketat (true = disarankan)
        //  - options     → opsi tambahan PDO (misal SSL CA bila ada)
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            // Options hanya diisi bila ekstensi pdo_mysql aktif;
            // array_filter membuang nilai null (misal MYSQL_ATTR_SSL_CA kosong).
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                Mysql::ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        // ── MARIADB (turunan MySQL — konfigurasi serupa) ───────────
        'mariadb' => [
            'driver' => 'mariadb',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                Mysql::ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        // ── PGSQL (PostgreSQL) — hanya contoh, tidak dipakai sistem ─
        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',        // skema default PostgreSQL
            'sslmode' => env('DB_SSLMODE', 'prefer'),
        ],

        // ── SQLSRV (SQL Server) — hanya contoh, tidak dipakai sistem ─
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Tabel Repository Migrasi (Migration Repository Table)
    |--------------------------------------------------------------------------
    | Tabel ini mencatat SEMUA migrasi yang sudah dijalankan pada database.
    | Dengan informasi ini Laravel tahu migrasi mana yang belum jalan
    | saat menjalankan `php artisan migrate`.
    |  - table → nama tabel (default 'migrations')
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    | Redis adalah key-value store cepat (in-memory) yang dipakai
    | untuk cache / queue. Bagian ini opsional — tidak wajib ada
    | untuk menjalankan aplikasi.
    |
    |  - client     → ekstensi redis yang dipakai ('phpredis' atau 'predis')
    |  - options    → pengaturan global (cluster, prefix key, persistent)
    |  - default    → koneksi redis utama (host/port/database)
    |  - cache      → koneksi redis khusus untuk cache (database terpisah)
    |    (dengan backoff_* untuk mengatur jeda percobaan ulang)
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            // Prefix key redis agar tidak bertabrakan antar aplikasi
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-database-'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],

        // Koneksi redis DEFAULT (untuk data umum)
        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

        // Koneksi redis untuk CACHE (database terpisah agar tidak campur)
        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

    ],

];