<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(),
            'slug' => fake()->slug(),
            'kategori' => fake()->randomElement(['Kegiatan', 'Pengumuman', 'Laporan']),
            'tanggal_kegiatan' => fake()->date(),
            'lokasi' => fake()->city(),
            'penyelenggara' => fake()->company(),
            'ringkasan' => fake()->sentence(),
            'konten' => fake()->paragraphs(3, true),
            'foto_utama' => null,
            'status' => 'published',
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }
}
