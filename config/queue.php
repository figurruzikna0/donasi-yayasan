<?php

/*
 * queue.php — Konfigurasi antrian (queue)
 * =========================================
 * Queue = antrian pekerjaan yang dijalankan BELAKANGAN (asinkron),
 * misalnya kirim email/notifikasi tanpa membuat user menunggu.
 * File ini mengatur:
 *  - default     → koneksi queue default
 *  - connections → daftar driver antrian (database, redis, sqs, dll.)
 *  - batching    → penyimpanan info job batch
 *  - failed      → penyimpanan job yang GAGAL
 *
 * Catatan sistem: aplikasi ini BELUM memakai queue untuk pekerjaan
 * (proses seperti kirim WA dilakukan sinkron saat request).
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Nama Koneksi Queue Default
    |--------------------------------------------------------------------------
    | Laravel mendukung banyak backend queue lewat satu API yang sama.
    | Koneksi default ditentukan di sini (default 'database' — antrian
    | disimpan di tabel jobs pada database).
    */

    'default' => env('QUEUE_CONNECTION', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    | Konfigurasi setiap backend queue yang dipakai aplikasi.
    |
    | Driver: "sync", "database", "beanstalkd", "sqs", "redis",
    |         "deferred", "background", "failover", "null"
    */

    'connections' => [

        // SYNC — jalankan job LANGSUNG saat dipanggil (sinkron).
        // Tanpa antrian — cocok untuk testing / development.
        'sync' => [
            'driver' => 'sync',
        ],

        // DATABASE — antrian disimpan pada tabel database.
        //  - connection   → koneksi DB (kosong = ikut default)
        //  - table        → tabel antrian (default 'jobs')
        //  - queue        → nama antrian default
        //  - retry_after  → detik sebelum job yang belum selesai
        //    dianggap gagal & boleh dicoba lagi (default 90 detik)
        //  - after_commit → transaksi selesai dulu, baru jalankan job
        'database' => [
            'driver' => 'database',
            'connection' => env('DB_QUEUE_CONNECTION'),
            'table' => env('DB_QUEUE_TABLE', 'jobs'),
            'queue' => env('DB_QUEUE', 'default'),
            'retry_after' => (int) env('DB_QUEUE_RETRY_AFTER', 90),
            'after_commit' => false,
        ],

        // BEANSTALKD — antrian via server Beanstalkd (opsional).
        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => env('BEANSTALKD_QUEUE_HOST', 'localhost'),
            'queue' => env('BEANSTALKD_QUEUE', 'default'),
            'retry_after' => (int) env('BEANSTALKD_QUEUE_RETRY_AFTER', 90),
            'block_for' => 0,
            'after_commit' => false,
        ],

        // SQS — antrian via Amazon SQS (cloud AWS).
        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        // REDIS — antrian via Redis (in-memory, cepat).
        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_QUEUE_CONNECTION', 'default'),
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => (int) env('REDIS_QUEUE_RETRY_AFTER', 90),
            'block_for' => null,
            'after_commit' => false,
        ],

        // DEFERRED — job ditunda sementara ke penyimpanan
        // sebelum diproses ke antrian asli.
        'deferred' => [
            'driver' => 'deferred',
        ],

        // BACKGROUND — jalankan job di proses background (Laravel 11+).
        'background' => [
            'driver' => 'background',
        ],

        // FAILOVER — coba koneksi pertama; kalau gagal, lanjut ke koneksi lain.
        'failover' => [
            'driver' => 'failover',
            'connections' => [
                'database',
                'deferred',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Job Batching
    |--------------------------------------------------------------------------
    | Konfigurasi database & tabel yang menyimpan info BATCH JOB
    | (kelompok beberapa job yang dieksekusi bersama & dipantau progresnya).
    |  - database → koneksi DB yang dipakai
    |  - table    → tabel penyimpanan batch (default 'job_batches')
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs (Job yang Gagal)
    |--------------------------------------------------------------------------
    | Pengaturan pencatatan job yang GAGAL diproses agar mudah ditelusuri
    | dan di-retry. Laravel mendukung penyimpanan di file atau database.
    |
    | Driver didukung: "database-uuids", "dynamodb", "file", "null"
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'failed_jobs',
    ],

];