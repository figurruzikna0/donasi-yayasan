<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'order_id',    // <-- Pastikan ini ada
        'snap_token',  // <-- Pastikan ini ada
        'donor_name',
        'donor_email',
        'amount',
        'payment_method',
        'payment_proof',
        'status',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}