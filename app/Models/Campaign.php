<?php

/*
 * Campaign — Model untuk tabel 'campaigns'
 * ==========================================
 * Tabel ini menyimpan data kampanye donasi (program penggalangan dana).
 * Setiap campaign bisa memiliki banyak donasi (1:M).
 *
 * Alur data:
 *   1. Admin buat campaign baru lewat form admin
 *   2. Donatur lihat campaign di halaman depan / dashboard
 *   3. Donatur pilih campaign → isi form donasi → upload bukti transfer
 *   4. Admin setujui → collected_amount otomatis bertambah
 *
 * Relasi:
 *   - hasMany Donation → campaign ini memiliki banyak donasi
 *
 * Event:
 *   - deleted → otomatis hapus file image dari storage
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Campaign extends Model
{
    use HasFactory;

    // Field yang bisa diisi massal
    protected $fillable = [
        'title',             // Judul campaign
        'slug',              // URL slug (auto-generated)
        'description',       // Deskripsi campaign
        'target_amount',     // Target donasi
        'collected_amount',  // Donasi terkumpul (bertambah otomatis saat approve)
        'image',             // Foto campaign (path storage)
        'status',            // active | inactive (buat filter tampilkan/nonaktifkan)
    ];

    // EVENT: saat campaign dihapus, hapus juga file gambarnya dari storage
    protected static function booted(): void
    {
        static::deleted(function (Campaign $campaign) {
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
        });
    }

    // RELASI: campaign memiliki banyak donasi (HasMany)
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}