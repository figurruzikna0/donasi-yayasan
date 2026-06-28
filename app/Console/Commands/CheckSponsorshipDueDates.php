<?php

namespace App\Console\Commands;

use App\Models\Sponsorship;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckSponsorshipDueDates extends Command
{
    protected $signature = 'sponsorships:check-due';
    protected $description = 'Kirim reminder WA H-3 jatuh tempo & non-aktifkan sponsorship yang lewat jatuh tempo tanpa perpanjangan';

    public function handle()
    {
        $this->sendReminders();
        $this->expireOverdue();
    }

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

            $message = "Halo {$sponsorship->donor_name}, sponsorship Anda untuk {$sponsorship->fosterChild?->name} akan berakhir pada {$sponsorship->expires_at->format('d M Y')}. Mohon lakukan perpanjangan agar dukungan tetap berlanjut. Terima kasih 🙏";

            $this->sendWhatsapp($sponsorship->donor_phone, $message);
            $sponsorship->update(['reminder_sent_at' => now()]);
        }

        $this->info("Reminder terkirim: {$sponsorships->count()}");
    }

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

            // Jangan reset status anak kalau ternyata sudah ada sponsorship baru yang masih aktif
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