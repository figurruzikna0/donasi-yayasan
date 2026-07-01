<?php

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

    /**
     * Kirim pesan beserta foto/gambar via Fonnte.
     * Hanya berhasil kalau:
     * 1. Paket Fonnte support attachment (super/advanced/ultra, bukan Free)
     * 2. APP_URL di .env bisa diakses publik dari internet (bukan 127.0.0.1)
     *
     * @param string $storagePath Path relatif file di storage/app/public
     *                            Contoh: 'child-developments/foto.jpg'
     */
    public function sendWithMedia(string $phone, string $message, string $storagePath): bool
    {
        $phone = $this->normalizePhone($phone);

        // Bangun URL publik dari APP_URL — jangan pakai asset() karena
        // bisa return localhost yang tidak bisa diakses server Fonnte
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

    /**
     * Pastikan nomor selalu dalam format internasional (62xxx) tanpa karakter
     * non-digit, apapun format yang dikirim pemanggil (08xx, +62xx, spasi, strip, dll).
     */
    private function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/\D/', '', $phone);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return $digits;
    }
}