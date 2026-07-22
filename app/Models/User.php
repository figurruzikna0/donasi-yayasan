<?php

// === User: model untuk tabel users, data donatur & admin (dibedakan via role) ===

namespace App\Models;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 👇👇👇 TAMBAHIN 'role' DI SINI BIAR BISA JADI ADMIN 👇👇👇
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

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification);
    }

    // --- RELASI: user memiliki banyak donasi (HasMany) ---
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // --- RELASI: user memiliki banyak sponsorship (HasMany) ---
    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class, 'user_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}