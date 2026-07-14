<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationSuccessMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Donation $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Donasi Berhasil — ' . ($this->donation->campaign?->title ?? 'Program Donasi'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.donations.success',
        );
    }
}
