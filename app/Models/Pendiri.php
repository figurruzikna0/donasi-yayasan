<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendiri extends Model
{
    use HasFactory;

    protected $table = 'pendiris';
    protected $fillable = ['nama', 'jabatan', 'deskripsi','foto'];
}