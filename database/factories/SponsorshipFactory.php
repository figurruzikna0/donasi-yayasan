<?php

/*
 * SponsorshipFactory — Factory untuk model Sponsorship
 * ======================================================
 * Factory menghasilkan data transaksi sponsorship (Orang Tua Asuh) dummy.
 * Ini factory PENTING untuk modul OTA: cocok dipakai testing alur
 * pending → approve → expired.
 *
 * Cara pakai:
 *   Sponsorship::factory()->create()        → sponsorship status pending
 *   Sponsorship::factory()->active()->create()   → status success, masa asuh aktif
 *   Sponsorship::factory()->expired()->create()  → sudah lewat masa asuh
 */

namespace Database\Factories;

use App\Models\FosterChild;
use App\Models\Sponsorship;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SponsorshipFactory extends Factory
{
    protected $model = Sponsorship::class;

    public function definition(): array
    {
        return [
            'foster_child_id' => FosterChild::factory(),  // relasi ke anak asuh (dibuat otomatis)
            'user_id' => User::factory(),                 // relasi ke donatur (dibuat otomatis)
            'order_id' => 'SPONSOR-' . fake()->unique()->randomNumber(8),  // ID transaksi unik berprefix SPONSOR-
            'donor_name' => fake()->name(),               // nama donatur
            'donor_email' => fake()->email(),             // email donatur
            'donor_phone' => '62' . fake()->numerify('8##########'),  // format HP Indonesia 62 8xx...
            'amount' => fake()->numberBetween(100000, 1000000),       // nominal 100rb – 1jt
            'package' => fake()->randomElement(['Reguler', 'Premium', 'Eksekutif']),  // paket komitmen acak
            'package_description' => fake()->sentence(),  // deskripsi paket
            'payment_method' => 'Transfer Bank',          // metode pembayaran manual
            'status' => 'pending',                        // status default: menunggu konfirmasi admin
        ];
    }

    // ── STATE: sponsorship AKTIF ─────────────────────────────
    // Mensimulasikan sponsorship yang sudah disetujui admin:
    // status success + masa asuh berjalan (mulai 2 bulan lalu,
    // berakhir 10 bulan lagi → total 12 bulan).
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'success',
            'starts_at' => now()->subMonths(2),
            'expires_at' => now()->addMonths(10),
        ]);
    }

    // ── STATE: sponsorship KADALUARSA ────────────────────────
    // Mensimulasikan sponsorship yang masa asuhnya SUDAH HABIS
    // (mulai 14 bulan lalu, berakhir 2 bulan lalu).
    // Berguna untuk menguji command CheckSponsorshipDueDates (auto-expire).
    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'success',
            'starts_at' => now()->subMonths(14),
            'expires_at' => now()->subMonths(2),
        ]);
    }
}