<?php

// === News: model untuk tabel news, berita/kegiatan yayasan ===

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    protected $fillable = [
        'judul',            // Judul berita
        'slug',             // URL slug (auto-generated dari judul)
        'kategori',         // Kategori berita (misal: kegiatan, pengumuman)
        'tanggal_kegiatan', // Tanggal pelaksanaan kegiatan
        'lokasi',           // Lokasi kegiatan
        'penyelenggara',    // Pihak penyelenggara kegiatan
        'ringkasan',        // Ringkasan singkat berita
        'konten',           // Isi/konten lengkap berita
        'foto_utama',       // Foto utama berita (path storage)
        'status',           // published | draft (status tayang)
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    // EVENT: saat berita dihapus, hapus juga foto utama dari storage
    protected static function booted(): void
    {
        static::deleted(function (News $news) {
            if ($news->foto_utama) {
                Storage::disk('public')->delete($news->foto_utama);
            }
        });
    }

    // Auto-generate slug unik dari judul
    public static function generateSlug(string $judul): string
    {
        $slug = Str::slug($judul);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    // Scope: ambil hanya berita yang sudah ditayangkan
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}