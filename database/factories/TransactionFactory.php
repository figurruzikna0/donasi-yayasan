<?php

/*
 * TransactionFactory — Factory untuk model Transaction
 * ======================================================
 * Catatan penting: model Transaction TIDAK dipakai aktif di sistem saat ini
 * (sistem memakai Donation & Sponsorship). Factory ini kemungkinan
 * peninggalan desain lama — tetap dipertahankan untuk kompatibilitas.
 *
 * Factory menghasilkan data transaksi dummy: donasi (default) atau sponsorship,
 * dengan relasi ke User & Campaign via factory lain.
 */

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    // Model yang diproduksi factory ini
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            // Nomor invoice unik: INV-{8 digit acak}
            'invoice_number' => 'INV-' . fake()->unique()->randomNumber(8),
            'user_id' => User::factory(),          // relasi ke user — dibuat otomatis via factory User
            'campaign_id' => Campaign::factory(),  // relasi ke campaign — dibuat otomatis via factory Campaign
            'foster_child_id' => null,             // null = transaksi donasi biasa (bukan sponsorship)
            'type' => 'donation',                  // jenis transaksi: 'donation' | 'sponsorship'
            'amount' => fake()->numberBetween(10000, 5000000),   // nominal acak 10rb – 5jt
            'donor_name' => fake()->name(),        // nama donatur acak
            'donor_phone' => fake()->phoneNumber(),// nomor HP donatur acak
            'status' => 'verified',                // status default: sudah terverifikasi
            'message' => null,                     // pesan donatur (opsional)
        ];
    }
}