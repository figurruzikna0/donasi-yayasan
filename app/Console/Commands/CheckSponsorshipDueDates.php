<?php

namespace App\Console\Commands;

use App\Models\Sponsorship;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckSponsorshipDueDates extends Command
{
    protected $signature = 'sponsorships:check-due';                            // Perintah untuk menjalankan command ini
    protected $description = 'Kirim WA reminder H-3 & auto-expire sponsorship kadaluarsa'; // Deskripsi command

    // ── ENTRY POINT ──────────────────────────────────────────
    // handle() dipanggil otomatis saat command dijalankan.
    // Jadwalnya ada di routes/console.php: setiap hari pukul 08:00 via scheduler.
    public function handle()
    {
        $this->sendReminders();    // 1. Kirim WA reminder H-3 ke donatur yang sponsorship-nya hampir habis
        $this->expireOverdue();    // 2. Auto-expire sponsorship yang sudah lewat tanggal berakhir
    }

    // ── 1. KIRIM WA REMINDER H-3 ────────────────────────────
    // Mencari sponsorship yang masa asuhnya TEPAT 3 HARI LAGI berakhir (bukan seluruh yang < 3 hari),
    // lalu kirim WhatsApp pengingat perpanjangan. Hanya diproses SEKALI per donatur.
    private function sendReminders()
    {
        // targetDate = tanggal H+3 dari hari ini (contoh: hari ini 12 Agu → target 15 Agu).
        // Pakai format('Y-m-d') agar cocok dengan kolom expires_at (tipe TIMESTAMP) saat dibandingkan per tanggal.
        $targetDate = now()->addDays(3)->format('Y-m-d');

        // Query sponsorship yang berhak dapat reminder, dengan 3 syarat sekaligus:
        $sponsorships = Sponsorship::with('fosterChild')          // 1. Preload data anak (hindari N+1 query)
            ->where('status', 'success')                          // 2. Hanya sponsorship yang masih AKTIF
            ->whereDate('expires_at', $targetDate)                // 3. Jatuh tempo tepat H+3 dari hari ini
            ->whereNull('reminder_sent_at')                       // 4. BELUM PERNAH di-remind → anti-spam (kirim sekali saja)
            ->get();

        // Loop setiap sponsorship yang memenuhi syarat:
        foreach ($sponsorships as $sponsorship) {
            if (! $sponsorship->donor_phone) {                    // Jika donatur tidak punya nomor HP → lewati (tidak bisa kirim WA)
                continue;
            }

            // Susun isi pesan WA: sapaan, nama anak, tanggal berakhir masa asuh, ajakan perpanjangan.
            $message = "Halo {$sponsorship->donor_name}, sponsorship Anda untuk {$sponsorship->fosterChild?->name} akan berakhir pada {$sponsorship->expires_at->format('d M Y')}. Mohon lakukan perpanjangan agar dukungan tetap berlanjut. Terima kasih";

            $this->sendWhatsapp($sponsorship->donor_phone, $message);        // Kirim WA via API Fonnte
            $sponsorship->update(['reminder_sent_at' => now()]);             // Tandai sudah dikirim → tidak akan terpilih lagi di pengecekan berikutnya
        }

        $this->info("Reminder terkirim: {$sponsorships->count()}");          // Output angka ke terminal (untuk log/verifikasi)
    }

    // ── 2. AUTO-EXPIRE SPONSORSHIP ───────────────────────────
    // Semua sponsorship berstatus 'success' tetapi sudah lewat tanggal expires_at
    // akan diubah menjadi 'expired'. Anak asuh yang kehilangan sponsorshipnya
    // dan tidak punya sponsorship aktif lain dikembalikan ke status 'Tersedia'.
    private function expireOverdue()
    {
        // Query sponsorship yang sudah MELEWATI batas waktu (expires_at < waktu sekarang)
        $expired = Sponsorship::where('status', 'success')
            ->where('expires_at', '<', now())
            ->get();

        foreach ($expired as $sponsorship) {
            $sponsorship->update(['status' => 'expired']);        // Ubah status transaksi menjadi expired (kadaluarsa)

            $child = $sponsorship->fosterChild;
            if (! $child) {                                       // Anak sudah terhapus → tidak perlu lanjut proses
                continue;
            }

            // Cek apakah anak masih punya sponsorship AKTIF lain (misal: perpanjangan dari donatur lain)
            $stillActive = Sponsorship::where('foster_child_id', $child->id)
                ->where('status', 'success')
                ->where('expires_at', '>=', now())                // Masih belum lewat jatuh tempo
                ->exists();

            // Jika TIDAK ada sponsorship aktif lain DAN status anak 'Diasuh' →
            // anak dikembalikan ke 'Tersedia' (bebas disponsori kembali)
            if (! $stillActive && $child->status === 'Diasuh') {
                $child->update(['status' => 'Tersedia']);
            }
        }

        $this->info("Sponsorship kadaluarsa: {$expired->count()}");           // Output jumlah ke terminal
    }

    // ── KIRIM WA VIA FONNTE ───────────────────────────────
    // Helper pengiriman WhatsApp. Token API dibaca dari config('services.fonnte.token')
    // (nilainya dari .env: FONNTE_TOKEN). Pesan dikirim lewat POST ke endpoint Fonnte.
    private function sendWhatsapp(string $phone, string $message)
    {
        try {
            // Http::withHeaders → set header Authorization (token API Fonnte)
            // lalu kirim POST ke https://api.fonnte.com/send dengan payload target (no HP) & message (isi pesan)
            Http::withHeaders([
                'Authorization' => config('services.fonnte.token'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message,
            ]);
        } catch (\Throwable $e) {
            // Jangan sampai kegagalan kirim WA menghentikan command lain —
            // cukup catat error ke terminal lalu lanjut proses berikutnya.
            $this->error("Gagal kirim WA ke {$phone}: " . $e->getMessage());
        }
    }
}