<?php

/*
 * Donation — Model untuk tabel 'donations'
 * =========================================
 * Tabel ini menyimpan semua data transaksi donasi kampanye.
 * Setiap baris = satu donasi dari donatur ke campaign tertentu.
 *
 * Alur data:
 *   1. Donatur isi form donasi → upload bukti transfer
 *   2. Data tersimpan dgn status 'pending'
 *   3. Admin setujui/tolak via TransactionController
 *   4. Jika disetujui → status 'success', invoice_number di-generate, campaign.collected_amount bertambah
 *   5. Donatur terima notifikasi WA + bisa download invoice PDF
 *
 * Relasi:
 *   - belongsTo Campaign  → donasi ini untuk campaign mana
 *   - belongsTo User      → donasi ini milik user (donatur) siapa
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',     // FK ke tabel campaigns
        'order_id',        // ID unik transaksi (format: DONASI-{uniqid})
        'snap_token',      // Token Midtrans (tidak dipakai lagi — sistem manual)
        'donor_name',      // Nama donatur (diinput manual di form)
        'donor_email',     // Email donatur
        'donor_phone',     // No HP donatur (untuk WA notifikasi)
        'user_id',         // FK ke tabel users (akun donatur yg login)
        'invoice_number',  // Nomor invoice format INV-DN-{YYYYMM}-{0001} (auto saat approve)
        'amount',          // Jumlah donasi (min 1.000)
        'payment_method',  // Metode bayar (Transfer Bank, dll)
        'payment_proof',   // Path file bukti transfer (storage/app/public/payment-proofs/)
        'transfer_date',   // Tanggal transfer
        'status',          // pending | success | failed
        'rejection_reason',// Alasan penolakan (jika status failed)
    ];

    protected $casts = [
        'transfer_date' => 'date',
    ];

    // Hapus otomatis file bukti transfer saat record donasi dihapus
    protected static function booted(): void
    {
        static::deleted(function (Donation $donation) {
            if ($donation->payment_proof) {
                Storage::disk('public')->delete($donation->payment_proof);
            }
        });
    }

    // RELASI: donasi milik satu campaign (BelongsTo)
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    // RELASI: donasi milik satu user/donatur (BelongsTo)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}