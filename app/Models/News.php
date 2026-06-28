<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'tanggal_kegiatan',
        'lokasi',
        'penyelenggara',
        'ringkasan',
        'konten',
        'foto_utama',
        'status',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

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