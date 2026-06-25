<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'target_amount', 
        'collected_amount', 'image', 'status'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}