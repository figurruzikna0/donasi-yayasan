<?php

namespace Database\Factories;

use App\Models\Pendiri;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendiriFactory extends Factory
{
    protected $model = Pendiri::class;

    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'jabatan' => fake()->randomElement(['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Pengawas']),
            'deskripsi' => fake()->sentence(),
            'foto' => null,
        ];
    }
}
