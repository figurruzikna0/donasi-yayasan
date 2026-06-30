<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildDevelopment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsorship_id',
        'foster_child_id',
        'user_id',
        'tanggal',
        'judul',
        'deskripsi',
        'foto',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Sponsorship (periode pengasuhan) tempat laporan ini berasal.
     */
    public function sponsorship(): BelongsTo
    {
        return $this->belongsTo(Sponsorship::class);
    }

    /**
     * Anak asuh yang dilaporkan perkembangannya.
     */
    public function fosterChild(): BelongsTo
    {
        return $this->belongsTo(FosterChild::class);
    }

    /**
     * Admin yang membuat laporan ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * URL foto laporan, atau null kalau tidak ada foto.
     */
    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}