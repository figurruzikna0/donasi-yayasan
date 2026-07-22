<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Alamat Email — Yayasan Baitul Yatim Sukabumi')
            ->greeting('Halo ' . ($notifiable->name ?? 'Pengguna') . ',')
            ->line('Terima kasih telah mendaftar di sistem informasi Yayasan Baitul Yatim Sukabumi.')
            ->line('Silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini untuk mengaktifkan akun:')
            ->action('Verifikasi Email Sekarang', $verificationUrl)
            ->line('Tautan verifikasi ini hanya berlaku selama 60 menit.')
            ->line('Jika Anda tidak merasa mendaftar di sistem kami, abaikan email ini.')
            ->salutation('Salam hangat,<br>' . config('app.name'));
    }
}
