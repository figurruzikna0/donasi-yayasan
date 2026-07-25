<?php

/*
 * auth.php — Route Autentikasi
 * =============================
 * Route ini di-include oleh web.php via require __DIR__.'/auth.php'
 * (Laravel Breeze menggunakan file terpisah untuk route auth).
 *
 * Struktur:
 *   [GUEST] → Login, Register, Lupa Password (hanya untuk user yang belum login)
 *   [AUTH]  → Verifikasi email, ganti password, logout (user sudah login)
 *
 * Semua route menggunakan throttle untuk mencegah brute force.
 */

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// ─── RUTE: GUEST (BELUM LOGIN) ────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');                               // Form daftar akun baru
    Route::post('register', [RegisteredUserController::class, 'store'])
        ->middleware('throttle:10,30');                    // Proses daftar (max 10x per 30 menit)

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');                                  // Form login
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:10,1');                     // Proses login (max 10x per menit)

    // Lupa password & reset
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');                       // Form lupa password
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');                         // Kirim link reset via email
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');                         // Form reset password (dari link email)
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');                         // Proses reset password
});

// ─── RUTE: AUTH (SUDAH LOGIN) ────────────────────────────
Route::middleware('auth')->group(function () {
    // Verifikasi email (wajib sebelum donasi/sponsorship)
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');                     // Notifikasi "verifikasi email dulu"
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');                    // Link verifikasi dari email
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');                      // Kirim ulang email verifikasi

    // Konfirmasi password (untuk aksi sensitif)
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');                       // Form konfirmasi password
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']); // Proses konfirmasi

    // Ganti password (saat sudah login)
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
