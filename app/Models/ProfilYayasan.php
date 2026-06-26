<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilYayasan extends Model
{
    protected $table = 'profil_yayasan'; 

    protected $fillable = [
        'nama_yayasan',
        'logo',
        'alamat',
        'no_telp',
        'email',
        'sejarah_yayasan',
        'visi',
        'misi', 
        'legalitas',
        'foto_legalitas',
        'foto_struktur'
    ];
}