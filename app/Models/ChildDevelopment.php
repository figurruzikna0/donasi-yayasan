<?php

// === ChildDevelopment: model untuk tabel child_developments, laporan perkembangan anak asuh ===

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
    // --- RELASI: child_development milik satu sponsorship (BelongsTo) ---
    public function sponsorship(): BelongsTo
    {
        return $this->belongsTo(Sponsorship::class);
    }

    /**
     * Anak asuh yang dilaporkan perkembangannya.
     */
    // --- RELASI: child_development milik satu foster_child (BelongsTo) ---
    public function fosterChild(): BelongsTo
    {
        return $this->belongsTo(FosterChild::class);
    }

    /**
     * Admin yang membuat laporan ini.
     */
    // --- RELASI: child_development dibuat oleh satu user/admin (BelongsTo) ---
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