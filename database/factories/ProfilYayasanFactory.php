<?php

namespace Database\Factories;

use App\Models\ProfilYayasan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilYayasanFactory extends Factory
{
    protected $model = ProfilYayasan::class;

    public function definition(): array
    {
        return [
            'nama_yayasan' => 'Yayasan Baitul Yatim Sukabumi',
            'alamat' => fake()->address(),
            'no_telp' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'sejarah_yayasan' => fake()->paragraph(),
            'visi' => fake()->sentence(),
            'misi' => fake()->paragraph(),
            'legalitas' => fake()->paragraph(),
            'logo' => null,
            'foto_legalitas' => null,
            'foto_struktur' => null,
            'foto_qris' => null,
        ];
    }
}
