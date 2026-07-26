<?php

/*
 * LoginRequest — Validasi & Autentikasi Login
 * =============================================
 * Menangani validasi input login (email + password), proses autentikasi
 * dengan pengecekan rate limiting (max 5 percobaan), serta menyediakan
 * throttle key untuk mencegah brute force.
 */

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    // --- OTORISASI: semua user diizinkan mengakses form login ---
    public function authorize(): bool
    {
        return true;
    }

    // --- ATURAN VALIDASI: email wajib valid, password wajib diisi ---
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    // --- AUTENTIKASI: coba login, lempar ValidationException jika gagal, bersihkan rate limiter jika sukses ---
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    // --- RATE LIMITER: cek batas percobaan login (max 5), lempar Lockout jika terlau banyak ---
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

            $menit = ceil($seconds / 60);
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan. Silakan coba lagi dalam $menit menit.",
            ]);
    }

    // --- THROTTLE KEY: buat key unik berdasarkan email + IP user ---
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
