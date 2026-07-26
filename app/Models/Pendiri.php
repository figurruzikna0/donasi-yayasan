<?php

// === Pendiri: model untuk tabel pendiris, data pendiri yayasan ===

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pendiri extends Model
{
    use HasFactory;

    protected $table = 'pendiris';
    protected $fillable = [
        'nama',      // Nama pendiri
        'jabatan',   // Jabatan di yayasan
        'deskripsi', // Deskripsi/biografi singkat
        'foto',      // Foto pendiri (path storage)
        'urutan',    // Urutan tampil (untuk sorting)
    ];

    // EVENT: saat data pendiri dihapus, hapus juga foto dari storage
    protected static function booted(): void
    {
        static::deleted(function (Pendiri $pendiri) {
            if ($pendiri->foto) {
                Storage::disk('public')->delete($pendiri->foto);
            }
        });
    }
}