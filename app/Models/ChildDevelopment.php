<?php

/*
 * ChildDevelopment — Model untuk tabel 'child_developments'
 * ===========================================================
 * Tabel ini menyimpan laporan perkembangan anak asuh (dibuat oleh admin).
 * Setiap laporan terkait dengan satu sponsorship dan satu anak asuh.
 *
 * Relasi:
 *   - belongsTo Sponsorship    → laporan ini untuk periode sponsorship mana
 *   - belongsTo FosterChild    → laporan ini untuk anak asuh siapa
 *   - belongsTo User           → laporan ini dibuat oleh admin siapa
 *
 * Accessor:
 *   - foto_url → URL lengkap untuk akses foto di storage
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ChildDevelopment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsorship_id',  // FK ke sponsorships
        'foster_child_id', // FK ke foster_children
        'user_id',         // FK ke users (admin pembuat laporan)
        'tanggal',         // Tanggal laporan
        'judul',           // Judul laporan
        'deskripsi',       // Isi laporan perkembangan
        'foto',            // Foto anak (path storage)
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Hapus foto dari storage saat laporan perkembangan dihapus
    protected static function booted(): void
    {
        static::deleted(function (ChildDevelopment $cd) {
            if ($cd->foto) {
                Storage::disk('public')->delete($cd->foto);
            }
        });
    }

    // RELASI: laporan ini milik sponsorship (periode pengasuhan) mana
    public function sponsorship(): BelongsTo
    {
        return $this->belongsTo(Sponsorship::class);
    }

    // RELASI: laporan ini untuk anak asuh siapa
    public function fosterChild(): BelongsTo
    {
        return $this->belongsTo(FosterChild::class);
    }

    // RELASI: laporan ini dibuat oleh admin/user siapa
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ACCESSOR: URL foto untuk tampilan di view
    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}