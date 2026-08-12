<?php

/*
 * FosterChildFactory — Factory untuk model FosterChild (Anak Asuh)
 * ==================================================================
 * Factory data anak asuh dummy — penting untuk modul OTA.
 * Default status 'Tersedia' (belum diasuh); ada state diasuh()
 * untuk anak yang sudah punya orang tua asuh.
 */

namespace Database\Factories;

use App\Models\FosterChild;
use Illuminate\Database\Eloquent\Factories\Factory;

class FosterChildFactory extends Factory
{
    protected $model = FosterChild::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),                                    // nama anak acak
            'age' => fake()->numberBetween(5, 18),                       // usia acak 5–18 tahun
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),  // jenis kelamin acak
            'description' => fake()->sentence(),                         // deskripsi/latar belakang anak
            'photo' => null,                                             // foto anak kosong
            'status' => 'Tersedia',                                      // default: belum diasuh
        ];
    }

    // ── STATE: anak SEDANG DIASUH ───────────────────────────
    // Mensimulasikan anak yang sudah memiliki sponsorship aktif.
    public function diasuh(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'Diasuh',
        ]);
    }
}