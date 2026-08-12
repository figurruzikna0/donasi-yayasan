<?php

/*
 * DonationFactory — Factory untuk model Donation (tabel donations)
 * ==================================================================
 * Factory data donasi kampanye dummy.
 * Default status 'pending' (menunggu konfirmasi admin).
 * Ada state success() dan failed() untuk mensimulasikan hasil konfirmasi.
 */

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    protected $model = Donation::class;

    public function definition(): array
    {
        return [
            'campaign_id' => Campaign::factory(),   // relasi ke kampanye (dibuat otomatis)
            'user_id' => User::factory(),           // relasi ke donatur (dibuat otomatis)
            'order_id' => 'DONASI-' . fake()->unique()->randomNumber(8),  // ID transaksi unik prefix DONASI-
            'donor_name' => fake()->name(),         // nama donatur
            'donor_email' => fake()->email(),       // email donatur
            'donor_phone' => fake()->phoneNumber(), // nomor HP donatur
            'amount' => fake()->numberBetween(10000, 5000000),   // nominal 10rb – 5jt
            'payment_method' => 'Transfer Bank',    // metode pembayaran manual
            'status' => 'pending',                  // default: menunggu konfirmasi admin
        ];
    }

    // ── STATE: donasi SUKSES ──────────────────────────────
    // Mensimulasikan donasi yang sudah dikonfirmasi admin.
    public function success(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'success',
        ]);
    }

    // ── STATE: donasi GAGAL ───────────────────────────────
    // Mensimulasikan donasi yang ditolak/dibatalkan.
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
        ]);
    }
}