<?php

/*
 * ResetPasswordNotification — Notifikasi Reset Password
 * =======================================================
 * Mengganti notifikasi reset password bawaan Laravel (Inggris) dengan versi
 * Bahasa Indonesia yang ramah dan sesuai branding Yayasan Baitul Yatim.
 *
 * Dipanggil otomatis dari AppServiceProvider@boot via:
 *   ResetPassword::toMailUsing(...)
 */

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    // Bangun dan kirim email reset password dalam Bahasa Indonesia
    public function toMail($notifiable): MailMessage
    {
        // Buat tautan reset dari token + email pengguna
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password — Yayasan Baitul Yatim Sukabumi')
            ->greeting('Assalamualaikum,')
            ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.')
            ->action('Reset Password', $url)
            ->line('Tautan reset password ini akan kedaluwarsa dalam 60 menit.')
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation('Wassalamualaikum wr. wb.');
    }
}
