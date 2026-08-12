<?php

/*
 * auth.php — Konfigurasi autentikasi
 * ====================================
 * File ini mengatur cara aplikasi mengelola LOGIN pengguna:
 *  - defaults  → guard & password reset default yang dipakai
 *  - guards    → cara request diotentikasi (misal: session berbasis cookie)
 *  - providers → sumber data pengguna (dari tabel mana / model mana)
 *  - passwords → pengaturan reset password (tabel token, masa berlaku, throttle)
 *  - password_timeout → berapa detik pengguna harus memasukkan ulang password
 *    saat membuka halaman sensitif (konfirmasi password).
 */

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Autentikasi (Authentication Defaults)
    |--------------------------------------------------------------------------
    | Menentukan guard dan password reset "broker" DEFAULT yang dipakai aplikasi.
    |  - 'guard'     → metode otentikasi default (di sini: 'web' = session cookie)
    |  - 'passwords' → broker reset password default (di sini: 'users')
    | Nilai bisa diubah sesuai kebutuhan, tetapi nilai ini standar paling aman.
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    | Setiap guard = cara otentikasi. Setiap guard WAJIB punya user provider
    | yang menentukan bagaimana pengguna diambil dari database.
    |  - driver: 'session' → status login disimpan dalam session/cookie
    |    (cocok untuk aplikasi web klasik seperti ini)
    |  - provider: 'users' → memakai provider bernama 'users' di bawah
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    | Provider menentukan bagaimana pengguna diambil dari penyimpanan.
    |  - driver 'eloquent' → memakai Model Eloquent (di sini: App\Models\User)
    |  - driver 'database' → memakai query langsung ke tabel (tanpa model)
    | Model ditentukan dari env AUTH_MODEL, default User::class
    | (tabel users milik aplikasi — berisi admin & donatur, dibedakan role).
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', User::class),
        ],

        // Contoh alternatif jika ingin memakai query langsung ke tabel:
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Reset Password (Resetting Passwords)
    |--------------------------------------------------------------------------
    | Konfigurasi fitur lupa password:
    |  - provider  → provider pengguna yang dipakai proses reset
    |  - table     → tabel penyimpan token reset (default: password_reset_tokens)
    |  - expire    → masa berlaku token reset (MENIT). Keamanan: token berumur
    |    pendek supaya sulit ditebak (di sini 60 menit).
    |  - throttle  → jeda DETIK sebelum pengguna bisa generate token baru
    |    (anti-spam: mencegah pembuatan token reset berlebihan dalam waktu singkat)
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    | Berapa DETIK batas waktu sebelum pengguna diminta memasukkan ulang
    | passwordnya saat mengakses halaman yang butuh konfirmasi password
    | (misal: form sensitif). Default 10800 detik = 3 jam.
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];