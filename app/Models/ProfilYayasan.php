<?php

// === ProfilYayasan: model untuk tabel profil_yayasan, menyimpan profil yayasan ===

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilYayasan extends Model
{
    protected $table = 'profil_yayasan'; 

    protected $fillable = [
        'nama_yayasan',    // Nama resmi yayasan
        'logo',            // File logo yayasan (path storage)
        'alamat',          // Alamat lengkap yayasan
        'no_telp',         // Nomor telepon yayasan
        'email',           // Email resmi yayasan
        'sejarah_yayasan', // Sejarah berdirinya yayasan
        'visi',            // Visi yayasan
        'misi',            // Misi yayasan
        'legalitas',       // Nomor/nama legalitas yayasan
        'foto_legalitas',  // Scan dokumen legalitas (path storage)
        'foto_struktur',   // Foto struktur organisasi (path storage)
    ];
}