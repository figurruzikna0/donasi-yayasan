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
        'donor_phone',
        'amount',
        'snap_token',
        'status',
        'package',
        'package_description',
        'payment_method',
        'starts_at',
        'expires_at',
        'reminder_sent_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
    ];

    public function fosterChild()
    {
        return $this->belongsTo(FosterChild::class);
    }

    /**
     * Normalisasi nomor WA jadi format internasional (62xxx) tanpa spasi/strip,
     * biar konsisten dipakai buat kirim notifikasi.
     */
    public function setDonorPhoneAttribute($value)
    {
        $digits = preg_replace('/\D/', '', (string) $value);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        $this->attributes['donor_phone'] = $digits;
    }

    public function isActive(): bool
    {
        return $this->status === 'success' && $this->expires_at && $this->expires_at->isFuture();
    }
}