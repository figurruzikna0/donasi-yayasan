<?php

/*
 * AppServiceProvider — Service Provider Utama
 * ============================================
 * Tempat mendaftarkan binding dan bootstrapping global aplikasi.
 *
 * Yang terdaftar saat ini:
 *   - ProfilYayasanComposer → otomatis kirim $profil ke SEMUA view
 *     Jadi di Blade mana pun bisa langsung {{ $profil->nama_yayasan }}
 *     tanpa perlu passing dari controller.
 */

namespace App\Providers;

use App\View\Composers\ProfilYayasanComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Tidak ada binding service yg didaftarkan
    }

    public function boot(): void
    {
        // Daftarkan View Composer global — $profil tersedia di semua view
        View::composer('*', ProfilYayasanComposer::class);
    }
}
