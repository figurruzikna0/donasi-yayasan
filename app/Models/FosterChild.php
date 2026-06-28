<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FosterChild extends Model
{
    use HasFactory;

    // Buka gembok kolom yang boleh diisi
    protected $fillable = [
        'name',
        'age',
        'description',
        'photo',
        'status',
    ];

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
}