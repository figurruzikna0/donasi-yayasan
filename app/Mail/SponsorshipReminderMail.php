<?php

namespace App\Mail;

use App\Models\Sponsorship;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SponsorshipReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Sponsorship $sponsorship;

    public function __construct(Sponsorship $sponsorship)
    {
        $this->sponsorship = $sponsorship;
    }

    public function envelope(): Envelope
    {
        $childName = $this->sponsorship->fosterChild?->name ?? 'Anak Asuh';
        return new Envelope(
            subject: "Sponsorship {$childName} Akan Berakhir — Perpanjang di Baitul Yatim",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.sponsorships.reminder',
        );
    }
}
