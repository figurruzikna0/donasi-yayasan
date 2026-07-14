<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'target_amount', 
        'collected_amount', 'image', 'status'
    ];

    protected static function booted(): void
    {
        static::deleted(function (Campaign $campaign) {
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
        });
    }


}