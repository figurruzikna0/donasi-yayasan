<?php

namespace App\Console\Commands;

use App\Mail\SponsorshipReminderMail;
use App\Models\Sponsorship;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendSponsorshipReminders extends Command
{
    protected $signature = 'sponsorships:check-due';
    protected $description = 'Send email reminders for sponsorships about to expire';

    public function handle()
    {
        $expiring = Sponsorship::with('fosterChild')
            ->where('status', 'success')
            ->whereNotNull('expires_at')
            ->whereNotNull('donor_email')
            ->where('expires_at', '<=', now()->addDays(7))
            ->where('expires_at', '>=', now())
            ->where(function ($q) {
                $q->whereNull('reminder_sent_at')
                  ->orWhere('reminder_sent_at', '<=', now()->subDays(7));
            })
            ->get();

        $sent = 0;
        foreach ($expiring as $sponsorship) {
            try {
                Mail::to($sponsorship->donor_email)->send(new SponsorshipReminderMail($sponsorship));
                $sponsorship->update(['reminder_sent_at' => now()]);
                $sent++;
            } catch (\Throwable $e) {
                $this->error("Gagal kirim reminder {$sponsorship->order_id}: {$e->getMessage()}");
            }
        }

        $this->info("Reminder terkirim: {$sent} dari {$expiring->count()} sponsorship.");
    }
}
