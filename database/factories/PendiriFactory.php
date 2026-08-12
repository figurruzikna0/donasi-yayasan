<?php

/*
 * PendiriFactory — Factory untuk model Pendiri (tabel pendiris)
 * ===============================================================
 * Factory data pendiri/pengurus yayasan dummy.
 * Dipakai untuk mengisi halaman profil yayasan (struktur pengurus).
 */

namespace Database\Factories;

use App\Models\Pendiri;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendiriFactory extends Factory
{
    protected $model = Pendiri::class;

    public function definition(): array
    {
        return [
            'nama' => fake()->name(),   // nama pendiri/pengurus acak
            'jabatan' => fake()->randomElement([   // jabatan acak dari daftar kepengurusan yayasan
                'Ketua',
                'Wakil Ketua',
                'Sekretaris',
                'Bendahara',
                'Pengawas',
            ]),
            'deskripsi' => fake()->sentence(),  // deskripsi singkat
            'foto' => null,                     // foto kosong (tidak upload file)
        ];
    }
}