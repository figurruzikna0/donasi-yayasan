<?php

// === Donation: model untuk tabel donations, menyimpan data donasi ===

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'order_id',
        'snap_token',
        'donor_name',
        'donor_email',
        'donor_phone',
        'user_id',
        'amount',
        'payment_method',
        'status',
    ];

    // --- RELASI: donasi milik satu campaign (BelongsTo) ---
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    // --- RELASI: donasi milik satu user/donatur (BelongsTo) ---
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}