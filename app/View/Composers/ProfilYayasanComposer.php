<?php

/*
 * ProfilYayasanComposer — View Composer Global
 * =============================================
 * File ini mendaftarkan variabel $profil ke SEMUA view di aplikasi.
 * Jadi di Blade mana pun bisa akses {{ $profil->nama_yayasan }} tanpa
 * harus passing data dari controller.
 *
 * Cara kerja:
 *   1. Terdaftar di AppServiceProvider (boot())
 *   2. Setiap kali view di-render, composer ini dipanggil
 *   3. Mengambil data ProfilYayasan pertama dari database
 *   4. Passing sebagai variabel $profil ke view
 *
 * Data yang tersedia di $profil:
 *   - nama_yayasan, alamat, phone, email
 *   - rekening (bank, nomor, atas_nama)
 *   - logo, legalitas (akta, SK Kemenkumham, NPWP)
 */

namespace App\View\Composers;

use App\Models\ProfilYayasan;
use Illuminate\View\View;

class ProfilYayasanComposer
{
    public function compose(View $view): void
    {
        $view->with('profil', ProfilYayasan::first());
    }
}
