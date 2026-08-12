<?php

/*
 * NewsFactory — Factory untuk model News (tabel news)
 * =====================================================
 * Factory data berita/kegiatan yayasan dummy.
 * Default status 'published' (langsung tampil); ada state draft()
 * untuk membuat berita yang masih draf.
 */

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(),      // judul berita acak
            'slug' => fake()->slug(),           // slug URL acak
            'kategori' => fake()->randomElement(['Kegiatan', 'Pengumuman', 'Laporan']),  // kategori acak
            'tanggal_kegiatan' => fake()->date(),  // tanggal pelaksanaan kegiatan
            'lokasi' => fake()->city(),          // lokasi kegiatan (nama kota acak)
            'penyelenggara' => fake()->company(),// pihak penyelenggara (nama perusahaan acak)
            'ringkasan' => fake()->sentence(),   // cuplikan singkat berita
            'konten' => fake()->paragraphs(3, true),  // isi berita 3 paragraf (digabung jadi 1 teks)
            'foto_utama' => null,                // gambar sampul kosong
            'status' => 'published',             // default: langsung dipublikasikan
        ];
    }

    // ── STATE: berita DRAF ─────────────────────────────────
    // Mengubah status menjadi 'draft' (belum tampil di publik).
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }
}