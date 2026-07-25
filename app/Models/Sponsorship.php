<?php

/*
 * Sponsorship — Model untuk tabel 'sponsorships'
 * ================================================
 * Tabel ini menyimpan data komitmen orang tua asuh (sponsorship).
 * Setiap baris = satu sponsorship dari donatur ke satu anak asuh.
 *
 * Alur data:
 *   1. Donatur pilih anak asuh → isi form sponsorship (paket komitmen)
 *   2. Upload bukti transfer → status 'pending'
 *   3. Admin setujui/tolak → jika approve, status 'success', starts_at=now, expires_at=+1 bulan
 *   4. Saat approve → status anak berubah jadi 'Diasuh'
 *   5. H-3 expired → WA reminder otomatis lewat scheduler (sponsorships:check-due)
 *   6. Lewat expired → status otomatis jadi 'expired', anak kembali 'Tersedia'
 *   7. Donatur bisa perpanjang dengan buat sponsorship baru
 *
 * Relasi:
 *   - belongsTo User        → sponsorship ini milik donatur siapa
 *   - belongsTo FosterChild → sponsorship ini untuk anak asuh siapa
 *
 * Mutator:
 *   - setDonorPhoneAttribute → otomatis normalisasi nomor HP ke format 62xxx
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sponsorship extends Model
{
    use HasFactory;
    protected $fillable = [
        'foster_child_id',    // FK ke tabel foster_children
        'user_id',            // FK ke tabel users (donatur)
        'order_id',           // ID unik transaksi (format: SPONSOR-{uniqid})
        'donor_name',         // Nama donatur (diinput manual)
        'donor_email',        // Email donatur
        'donor_phone',        // No HP donatur (auto-normalisasi ke 62xxx)
        'amount',             // Nominal per bulan (100.000 - 500.000)
        'snap_token',         // Token Midtrans (tidak dipakai)
        'status',             // pending | success | expired | failed
        'package',            // Nama paket (Pendidikan, Kesehatan, dll)
        'package_description',// Deskripsi paket (opsional)
        'payment_method',     // Transfer Bank / etc
        'payment_proof',      // Path file bukti transfer
        'transfer_date',      // Tanggal transfer
        'starts_at',          // Tanggal mulai (diisi admin saat approve)
        'expires_at',         // Tanggal berakhir (+1 bulan dari starts_at)
        'reminder_sent_at',   // Timestamp WA reminder H-3 (diisi oleh scheduler)
        'rejection_reason',   // Alasan penolakan (jika ditolak admin)
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
        'transfer_date' => 'date',
    ];

    // RELASI: sponsorship milik satu user/donatur (BelongsTo)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI: sponsorship milik satu foster_child (BelongsTo)
    public function fosterChild()
    {
        return $this->belongsTo(FosterChild::class, 'foster_child_id');
    }

    // Hapus otomatis file bukti transfer saat record sponsorship dihapus
    protected static function booted(): void
    {
        static::deleted(function (Sponsorship $sponsorship) {
            if ($sponsorship->payment_proof) {
                Storage::disk('public')->delete($sponsorship->payment_proof);
            }
        });
    }

    // MUTATOR: otomatis normalisasi nomor HP ke format 62xxx saat disimpan
    // Contoh: 08xxx → 628xxx, +62xxx → 62xxx
    public function setDonorPhoneAttribute($value)
    {
        $digits = preg_replace('/\D/', '', (string) $value);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        $this->attributes['donor_phone'] = $digits;
    }

    // HELPER: cek apakah sponsorship masih aktif (status success & belum expired)
    public function isActive(): bool
    {
        return $this->status === 'success' && $this->expires_at && $this->expires_at->isFuture();
    }
}