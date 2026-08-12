<?php

/*
 * sanctum.php — Konfigurasi Laravel Sanctum
 * ===========================================
 * Sanctum = paket autentikasi Laravel untuk SPA (Single Page App)
 * dan API token. File ini mengatur:
 *  - stateful domains → domain yang memakai auth berbasis cookie
 *  - guard            → guard yang dicek saat otentikasi
 *  - expiration       → masa berlaku token API
 *  - token_prefix     → awalan token (anti kebocoran ke repo)
 *  - middleware       → middleware khusus yang dipakai Sanctum
 *
 * Catatan sistem: aplikasi ini TIDAK aktif memakai API/SPA — auth utama
 * memakai session (guard 'web'). Konfigurasi ini bawaan Laravel 11.
 */

use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Laravel\Sanctum\Http\Middleware\AuthenticateSession;
use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    | Request dari domain/daftar ini akan menerima autentikasi API "stateful"
    | berbasis SESSION COOKIE (bukan token). Biasanya berisi domain lokal
    | dan produksi yang mengakses API lewat frontend SPA.
    |
    | Nilainya: localhost, localhost:3000, 127.0.0.1, 127.0.0.1:8000, ::1
    | lalu ditambahkan URL aplikasi saat ini beserta port-nya.
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
        Sanctum::currentApplicationUrlWithPort(),
        // Sanctum::currentRequestHost(),   // alternatif (dikomentari)
    ))),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guards
    |--------------------------------------------------------------------------
    | Daftar guard yang dicek saat Sanctum mencoba mengotentikasi request.
    | Jika tidak ada guard yang berhasil, Sanctum akan mencoba memakai
    | bearer token yang ada pada request masuk.
    */

    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Masa Berlaku Token (Expiration Minutes)
    |--------------------------------------------------------------------------
    | Jumlah MENIT sampai sebuah token dianggap kadaluarsa.
    | Nilai ini menimpa atribut expires_at token, tetapi TIDAK memengaruhi
    | session first-party (login web biasa). null = token tidak pernah kadaluarsa.
    */

    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    | Sanctum dapat memberi AWALAN pada token baru, supaya platform
    | pemindai keamanan (misal GitHub secret scanning) bisa mendeteksi
    | bila token tanpa sengaja ter-commit ke repository.
    */

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Middleware
    |--------------------------------------------------------------------------
    | Saat mengotentikasi SPA dengan Sanctum, Anda bisa menyesuaikan
    | middleware yang dipakai Sanctum saat memproses request:
    |  - authenticate_session → aktifkan session auth untuk SPA
    |  - encrypt_cookies      → enkripsi cookie
    |  - validate_csrf_token  → validasi token CSRF (keamanan form)
    */

    'middleware' => [
        'authenticate_session' => AuthenticateSession::class,
        'encrypt_cookies' => EncryptCookies::class,
        'validate_csrf_token' => ValidateCsrfToken::class,
    ],

];