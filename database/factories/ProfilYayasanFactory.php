<?php

/*
 * ProfilYayasanFactory — Factory untuk model ProfilYayasan
 * ==========================================================
 * Factory data profil yayasan. Karena tabel profil_yayasan bersifat
 * SINGLE-ROW (hanya 1 record yayasan), factory ini biasanya dipakai
 * sekali saat seeding/testing.
 */

namespace Database\Factories;

use App\Models\ProfilYayasan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilYayasanFactory extends Factory
{
    protected $model = ProfilYayasan::class;

    public function definition(): array
    {
        return [
            'nama_yayasan' => 'Yayasan Baitul Yatim Sukabumi',  // nama yayasan DIFIX (bukan acak)
            'alamat' => fake()->address(),                      // alamat acak
            'no_telp' => fake()->phoneNumber(),                 // nomor telepon acak
            'email' => fake()->email(),                         // email acak
            'sejarah_yayasan' => fake()->paragraph(),           // sejarah (1 paragraf acak)
            'visi' => fake()->sentence(),                       // visi (1 kalimat)
            'misi' => fake()->paragraph(),                      // misi (1 paragraf)
            'legalitas' => fake()->paragraph(),                 // legalitas
            'logo' => null,                                     // logo kosong (tidak upload file)
            'foto_legalitas' => null,                           // foto legalitas kosong
            'foto_struktur' => null,                            // foto struktur kosong
        ];
    }
}