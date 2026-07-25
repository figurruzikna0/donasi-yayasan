<?php

/*
 * FonnteService — Layanan WhatsApp Gateway via Fonnte.com
 * ========================================================
 * Service ini digunakan oleh berbagai controller untuk mengirim notifikasi WA ke donatur.
 * Fonnte adalah API gateway WhatsApp yang mengirim pesan ke nomor tujuan.
 *
 * Cara pakai:
 *   $fonnte = new FonnteService();
 *   $fonnte->send('08123456789', 'Halo, terima kasih!');
 *   $fonnte->sendWithMedia('08123456789', 'Laporan anak asuh', 'child-developments/foto.jpg');
 *
 * Konfigurasi:
 *   - Token di .env: FONNTE_TOKEN=...
 *   - Untuk kirim foto (sendWithMedia): APP_URL harus bisa diakses publik
 *
 * Normalisasi nomor:
 *   - Semua nomor otomatis dikonversi ke format 62xxx saat dikirim ke API Fonnte
 *   - 08123456789 → 628123456789
 *   - +628123456789 → 628123456789
 */

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected string $token;
    protected string $apiUrl = 'https://api.fonnte.com/send';

    public function __construct()
    {
        $token = config('services.fonnte.token');

        if (empty($token)) {
            throw new \RuntimeException('FONNTE_TOKEN belum diatur di .env / config/services.php');
        }

        $this->token = $token;
    }

    // Kirim pesan teks WA biasa
    public function send(string $phone, string $message): bool
    {
        $phone = $this->normalizePhone($phone);

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->apiUrl, [
                'target'  => $phone,
                'message' => $message,
            ]);

            if ($response->successful()) {
                Log::info('Fonnte WA sent', ['phone' => $phone, 'response' => $response->json()]);
                return true;
            }

            Log::error('Fonnte WA failed', ['phone' => $phone, 'response' => $response->json()]);
            return false;

        } catch (\Exception $e) {
            Log::error('Fonnte exception', ['phone' => $phone, 'message' => $e->getMessage()]);
            return false;
        }
    }

    // Kirim pesan WA dengan lampiran foto/gambar
    // Catatan: hanya support paket Fonnte berbayar (bukan Free)
    public function sendWithMedia(string $phone, string $message, string $storagePath): bool
    {
        $phone = $this->normalizePhone($phone);

        // Bangun URL publik dari APP_URL
        $publicUrl = rtrim(config('app.url'), '/') . '/storage/' . $storagePath;

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->apiUrl, [
                'target'  => $phone,
                'message' => $message,
                'url'     => $publicUrl,
            ]);

            if ($response->successful()) {
                Log::info('Fonnte WA+foto sent', [
                    'phone'    => $phone,
                    'url'      => $publicUrl,
                    'response' => $response->json(),
                ]);
                return true;
            }

            Log::error('Fonnte WA+foto failed', [
                'phone'    => $phone,
                'url'      => $publicUrl,
                'response' => $response->json(),
            ]);
            return false;

        } catch (\Exception $e) {
            Log::error('Fonnte exception (media)', [
                'phone'   => $phone,
                'url'     => $publicUrl,
                'message' => $e->getMessage(),
            ]);
            return false;
        }
    }

    // Normalisasi nomor HP ke format internasional 62xxx
    private function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/\D/', '', $phone);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return $digits;
    }
}