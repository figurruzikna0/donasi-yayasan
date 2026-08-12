<?php

/*
 * logging.php — Konfigurasi log
 * ===============================
 * File ini mengatur SISTEM PENCATATAN (log) aplikasi:
 *  - default      → channel log default
 *  - deprecations → channel khusus untuk peringatan fitur PHP/library usang
 *  - channels     → daftar channel (tujuan penulisan log) yang tersedia
 *
 * Konteks sistem: error biasa dicatat ke storage/logs/laravel.log
 * (channel 'stack' → 'single').
 */

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Channel Log Default
    |--------------------------------------------------------------------------
    | Channel yang dipakai untuk menulis pesan log bila tidak disebutkan
    | channel lain secara eksplisit. Nilai harus cocok dengan salah satu
    | channel di daftar 'channels' di bawah. Default 'stack' (gabungan
    | beberapa channel sekaligus).
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Channel Log Deprecations
    |--------------------------------------------------------------------------
    | Channel untuk mencatat peringatan fitur PHP/library yang SUDAH USANG
    | (deprecated). Berguna menyiapkan aplikasi sebelum upgrade besar.
    |  - channel → 'null' = matikan pencatatan deprecation (default)
    |  - trace   → sertakan stack trace pada log deprecation?
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    | Daftar channel log. Laravel memakai library Monolog yang punya banyak
    | handler dan formatter.
    |
    | Driver yang tersedia: "single", "daily", "slack", "syslog",
    |                       "errorlog", "monolog", "custom", "stack"
    */

    'channels' => [

        // STACK — memanggil BEBERAPA channel sekaligus dalam satu pesan.
        // 'channels' diisi daftar channel (default: 'single').
        'stack' => [
            'driver' => 'stack',
            'channels' => explode(',', (string) env('LOG_STACK', 'single')),
            'ignore_exceptions' => false,
        ],

        // SINGLE — tulis semua log ke SATU file (storage/logs/laravel.log).
        //  - level → level minimum yang dicatat (debug = semua level)
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        // DAILY — tulis log per HARI (laravel-YYYY-MM-DD.log), file lama
        // otomatis dihapus setelah 'days' hari (default 14).
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => env('LOG_DAILY_DAYS', 14),
            'replace_placeholders' => true,
        ],

        // SLACK — kirim log ke channel Slack via webhook URL.
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => env('LOG_SLACK_USERNAME', env('APP_NAME', 'Laravel')),
            'emoji' => env('LOG_SLACK_EMOJI', ':boom:'),
            'level' => env('LOG_LEVEL', 'critical'),
            'replace_placeholders' => true,
        ],

        // PAPERTRAIL — kirim log ke layanan Papertrail (aggregator log)
        // via SyslogUdpHandler (UDP/TLS ke host & port yang diset).
        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        // STDERR — tulis log ke stderr (biasa untuk CLI/Docker).
        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'handler_with' => [
                'stream' => 'php://stderr',
            ],
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'processors' => [PsrLogMessageProcessor::class],
        ],

        // SYSLOG — tulis log ke sistem syslog server.
        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
            'facility' => env('LOG_SYSLOG_FACILITY', LOG_USER),
            'replace_placeholders' => true,
        ],

        // ERRORLOG — tulis log ke error log bawaan PHP.
        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        // NULL — buang semua pesan log (handler kosong).
        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        // EMERGENCY — channel khusus untuk error fatal (laravel.log)
        // dipakai saat sistem log utama gagal.
        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

    ],

];