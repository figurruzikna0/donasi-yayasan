<?php

/*
 * CheckSponsorshipDueDates — Artisan Command: sponsorships:check-due
 * ===================================================================
 * Command ini dijalankan OTOMATIS setiap hari jam 08:00 via scheduler.
 * Dua tugas utama:
 *
 * 1. KIRIM REMINDER (H-3)
 *    Cari sponsorship aktif yg expires_at = H+3 dari sekarang & belum pernah di-remind.
 *    Kirim WA: "Segera perpanjang masa asuh Anda..."
 *    Tandai reminder_sent_at = now() biar tidak dikirim ulang.
 *
 * 2. AUTO-EXPIRE (lewat jatuh tempo)
 *    Cari sponsorship dgn status 'success' tapi expires_at < sekarang.
 *    Ubah status jadi 'expired'.
 *    Jika anak tidak punya sponsorship aktif lain → ubah status anak ke 'Tersedia'.
 *
 * Cara test manual:
 *   php artisan sponsorships:check-due
 *
 * Scheduler terdaftar di routes/console.php:
 *   Schedule::command('sponsorships:check-due')->dailyAt('08:00');
 */

namespace App\Console\Commands;

use App\Models\Sponsorship;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckSponsorshipDueDates extends Command
{
    protected $signature = 'sponsorships:check-due';
    protected $description = 'Kirim WA reminder H-3 & auto-expire sponsorship kadaluarsa';

    // ── ENTRY POINT ──────────────────────────────────────────
    public function handle()
    {
        $this->sendReminders();    // 1. Kirim WA H-3
        $this->expireOverdue();    // 2. Auto-expire
    }

    // ── 1. KIRIM WA REMINDER H-3 ────────────────────────────
    // Cari sponsorship yg expires_at = H+3 dr sekarang & belum dapat reminder
    private function sendReminders()
    {
        $targetDate = now()->addDays(3)->format('Y-m-d');

        $sponsorships = Sponsorship::with('fosterChild')
            ->where('status', 'success')
            ->whereDate('expires_at', $targetDate)
            ->whereNull('reminder_sent_at')
            ->get();

        foreach ($sponsorships as $sponsorship) {
            if (! $sponsorship->donor_phone) {
                continue;
            }

            $message = "Halo {$sponsorship->donor_name}, sponsorship Anda untuk {$sponsorship->fosterChild?->name} akan berakhir pada {$sponsorship->expires_at->format('d M Y')}. Mohon lakukan perpanjangan agar dukungan tetap berlanjut. Terima kasih";

            $this->sendWhatsapp($sponsorship->donor_phone, $message);
            $sponsorship->update(['reminder_sent_at' => now()]);
        }

        $this->info("Reminder terkirim: {$sponsorships->count()}");
    }

    // ── 2. AUTO-EXPIRE SPONSORSHIP ───────────────────────────
    // Cari sponsorship yg sudah lewat expires_at, ubah status jadi expired
    // Jika anak tidak punya sponsorship aktif lain → ubah status ke 'Tersedia'
    private function expireOverdue()
    {
        $expired = Sponsorship::where('status', 'success')
            ->where('expires_at', '<', now())
            ->get();

        foreach ($expired as $sponsorship) {
            $sponsorship->update(['status' => 'expired']);

            $child = $sponsorship->fosterChild;
            if (! $child) {
                continue;
            }

            // Cek apakah anak masih punya sponsorship aktif lain
            $stillActive = Sponsorship::where('foster_child_id', $child->id)
                ->where('status', 'success')
                ->where('expires_at', '>=', now())
                ->exists();

            if (! $stillActive && $child->status === 'Diasuh') {
                $child->update(['status' => 'Tersedia']);
            }
        }

        $this->info("Sponsorship kadaluarsa: {$expired->count()}");
    }

    // ── KIRIM WA VIA FONNTE ───────────────────────────────
    private function sendWhatsapp(string $phone, string $message)
    {
        try {
            Http::withHeaders([
                'Authorization' => config('services.fonnte.token'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message,
            ]);
        } catch (\Throwable $e) {
            $this->error("Gagal kirim WA ke {$phone}: " . $e->getMessage());
        }
    }
}