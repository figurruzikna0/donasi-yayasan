<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FosterChild extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'description',
        'photo',
        'status',
        'jenis_kelamin', // ★ TAMBAHAN
    ];

    protected static function booted(): void
    {
        static::deleted(function (FosterChild $fosterChild) {
            if ($fosterChild->photo) {
                Storage::disk('public')->delete($fosterChild->photo);
            }
        });
    }

    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class);
    }

    public function activeSponsorship()
    {
        return $this->hasOne(Sponsorship::class)
            ->where('status', 'success')
            ->latestOfMany('expires_at');
    }

    // ★ TAMBAHAN: relasi ke laporan perkembangan
    public function developments()
    {
        return $this->hasMany(ChildDevelopment::class)
            ->orderByDesc('tanggal');
    }
}