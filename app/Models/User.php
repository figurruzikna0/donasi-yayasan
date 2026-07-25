<?php

/*
 * User — Model untuk tabel 'users'
 * ==================================
 * Tabel ini menyimpan data semua pengguna: ADMIN dan DONATUR.
 * Dibedakan via kolom 'role' (admin | donatur).
 *
 * Perbedaan Admin vs Donatur:
 *   - Admin → akses panel admin (/admin/*), kelola semua data
 *   - Donatur → akses dashboard donatur, donasi, sponsorship
 *
 * Alur registrasi:
 *   1. User daftar lewat form register → role otomatis 'donatur'
 *   2. Admin dibuat via seeder atau langsung ke database
 *   3. Setiap user wajib verifikasi email sebelum bisa donasi
 *
 * Relasi:
 *   - hasMany Donation     → user ini punya banyak donasi
 *   - hasMany Sponsorship  → user ini punya banyak sponsorship
 *
 * Helper:
 *   - isAdmin()    → cek apakah user punya role admin
 *   - isDonatur()  → cek apakah user role donatur
 */

namespace App\Models;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

// Field yang boleh diisi massal
#[Fillable(['name', 'email', 'password', 'role', 'phone', 'address', 'nik', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Hapus avatar dari storage saat user dihapus
    protected static function booted(): void
    {
        static::deleted(function (User $user) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
        });
    }

    // Kirim notifikasi verifikasi email kustom (via VerifyEmailNotification)
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification);
    }

    // RELASI: satu user memiliki banyak donasi (HasMany)
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // RELASI: satu user memiliki banyak sponsorship (HasMany)
    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class, 'user_id');
    }

    // HELPER: cek apakah user adalah admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // HELPER: cek apakah user adalah donatur
    public function isDonatur(): bool
    {
        return $this->role === 'donatur';
    }
}