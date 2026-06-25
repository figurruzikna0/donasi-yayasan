<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number', 'user_id', 'campaign_id', 'foster_child_id',
        'type', 'amount', 'donor_name', 'donor_phone', 
        'payment_proof', 'status', 'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function fosterChild()
    {
        return $this->belongsTo(FosterChild::class);
    }
}