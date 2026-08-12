<?php

/*
 * DatabaseSeeder — Seeder utama aplikasi
 * ========================================
 * Seeder = skrip mengisi database dengan data awal (awal/uji coba).
 * Dijalankan dengan perintah: php artisan db:seed
 *
 * Fungsi seeder ini: membuat 1 akun ADMIN awal dari nilai .env,
 * sehingga proyek langsung punya akun admin setelah install.
 *
 * Variabel .env yang dipakai:
 *   ADMIN_NAME     → nama admin (default 'Admin Yayasan')
 *   ADMIN_EMAIL    → email login admin (WAJIB diisi agar admin dibuat)
 *   ADMIN_PASSWORD → password login admin (WAJIB diisi agar admin dibuat)
 */

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Buat enkripsi password

class DatabaseSeeder extends Seeder
{
    // WithoutModelEvents: mencegah event model berjalan saat seeding
    // (misal event 'deleted' / 'created' di model) — mempercepat proses.
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // HANYA buat admin bila ADMIN_EMAIL dan ADMIN_PASSWORD sudah diisi di .env
        // (penjagaan agar tidak membuat akun asal saat seeder dijalankan tanpa konfigurasi).
        if (env('ADMIN_EMAIL') && env('ADMIN_PASSWORD')) {
            User::factory()->create([
                'name' => env('ADMIN_NAME', 'Admin Yayasan'),       // nama dari .env, default 'Admin Yayasan'
                'email' => env('ADMIN_EMAIL'),                      // email admin
                'password' => Hash::make(env('ADMIN_PASSWORD')),    // password DI-ENKRIPSI hash (jangan simpan plaintext)
                'role' => 'admin',                                  // role admin = akses panel admin
            ]);
        }

    }
}