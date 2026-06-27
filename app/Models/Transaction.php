<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number', 
        'user_id', 
        'campaign_id', 
        'foster_child_id',
        'type',          // Bisa diisi 'donasi' atau 'sponsor'
        'amount', 
        'donor_name', 
        'donor_email',   // Pastikan kolom ini ada di database-mu
        'donor_phone', 
        'payment_proof', 
        'payment_method',// Baru: Tambahkan ini
        'package',       // Baru: Tambahkan ini (Bronze/Silver/Gold)
        'status',        // pending, success, failed
        'message'
    ];

    // Relasi tetap sama
    public function user() { return $this->belongsTo(User::class); }
    public function campaign() { return $this->belongsTo(Campaign::class); }
    public function fosterChild() { return $this->belongsTo(FosterChild::class); }
}