<?php

/*
 * UserFactory — Factory untuk model User (tabel users)
 * ======================================================
 * Factory = "pabrik data dummy" untuk keperluan testing/seeding.
 * File ini menghasilkan data pengguna acak yang valid sesuai struktur
 * kolom tabel users (id, name, email, password, role, dll.).
 *
 * Cara pakai:
 *   User::factory()->create()              → buat 1 user (role donatur)
 *   User::factory()->create(['role' => 'admin']) → user role admin
 *   User::factory()->unverified()          → user dengan email belum diverifikasi
 */

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Password yang sedang dipakai factory.
     * Dideklarasikan static agar password di-HASH HANYA SEKALI
     * untuk semua user (efisiensi — tidak rehash untuk tiap record).
     */
    protected static ?string $password;

    /**
     * Definisikan state DEFAULT model.
     * Array ini dipakai sebagai "kerangka" data setiap kali factory dipanggil.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),                    // nama acak (Faker)
            'email' => fake()->unique()->safeEmail(),    // email acak, dijamin UNIK
            'email_verified_at' => now(),                // email langsung terverifikasi saat dibuat
            'password' => static::$password ??= Hash::make('password'),  // hash password 'password' (sekali saja)
            'remember_token' => Str::random(10),         // token remember me acak 10 karakter
            'role' => 'donatur',                         // default role = donatur (bukan admin)
        ];
    }

    /**
     * State khusus: tandai email BELUM diverifikasi.
     * Memakai ->state() untuk MENIMPA nilai kolom tertentu
     * (di sini email_verified_at dibuat null).
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}