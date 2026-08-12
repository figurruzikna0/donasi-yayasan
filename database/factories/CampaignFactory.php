<?php

/*
 * CampaignFactory — Factory untuk model Campaign (tabel campaigns)
 * ==================================================================
 * Factory data kampanye donasi dummy.
 * Judul dibuat UNIK lalu diubah menjadi slug (format URL).
 * Default status 'active'; ada state completed() untuk kampanye selesai.
 */

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        // Judul dibuat dulu di variabel agar bisa dipakai slug
        // (slug harus berasal dari judul yang sama).
        $title = fake()->unique()->sentence(3);

        return [
            'title' => $title,                    // judul kampanye acak (3 kata)
            'slug' => Str::slug($title),          // slug otomatis dari judul (huruf kecil, strip)
            'description' => fake()->paragraph(),  // deskripsi kampanye
            'target_amount' => fake()->numberBetween(1000000, 100000000),  // target dana 1jt – 100jt
            'collected_amount' => 0,              // dana terkumpul mulai 0
            'image' => 'campaigns/test.jpg',      // gambar default (path contoh)
            'status' => 'active',                 // default: kampanye aktif
        ];
    }

    // ── STATE: kampanye SELESAI ────────────────────────────
    // Mengubah status menjadi 'completed' (target tercapai/ditutup).
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }
}