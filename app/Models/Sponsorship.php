<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
    'foster_child_id',
    'order_id',
    'donor_name',
    'donor_email',
    'amount',
    'snap_token',
    'status',
    'package',
    'package_description',
    'payment_method',
    ];

    public function fosterChild()
    {
        return $this->belongsTo(FosterChild::class);
    }
}