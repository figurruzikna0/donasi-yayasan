<?php
// === InvoiceController: menampilkan dan mengunduh invoice donasi, sponsorship, & laporan perkembangan ===

namespace App\Http\Controllers;

use App\Models\ChildDevelopment;
use App\Models\Donation;
use App\Models\ProfilYayasan;
use App\Models\Sponsorship;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    // --- TAMPILKAN INVOICE DONASI: menerima $id donasi, cek status success, cek kepemilikan, tampilkan halaman invoice donasi ---
    public function donation($id)
    {
        $donation = Donation::with('campaign')->findOrFail($id);

        if ($donation->status !== 'success') {
            abort(404);
        }

        if ($donation->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('invoices.donation', compact('donation'));
    }

    // --- TAMPILKAN INVOICE SPONSORSHIP: menerima $id sponsorship, cek status success, cek kepemilikan, tampilkan halaman invoice sponsorship ---
    public function sponsorship($id)
    {
        $sponsorship = Sponsorship::with('fosterChild')->findOrFail($id);

        if ($sponsorship->status !== 'success') {
            abort(404);
        }

        if ($sponsorship->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('invoices.sponsorship', compact('sponsorship'));
    }

    // --- DOWNLOAD PDF DONASI: menerima $id donasi, cek status success, generate PDF invoice donasi, return download ---
    public function donationPdf($id)
    {
        $donation = Donation::with('campaign')->findOrFail($id);

        if ($donation->status !== 'success') {
            abort(404);
        }

        if ($donation->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $profil = ProfilYayasan::first();
        $pdf = Pdf::loadView('invoices.donation_pdf', compact('donation', 'profil'));
        return $pdf->download('invoice-donasi-'.$donation->order_id.'.pdf');
    }

    // --- DOWNLOAD PDF SPONSORSHIP: menerima $id sponsorship, cek status success, generate PDF invoice, return download ---
    public function sponsorshipPdf($id)
    {
        $sponsorship = Sponsorship::with('fosterChild')->findOrFail($id);

        if ($sponsorship->status !== 'success') {
            abort(404);
        }

        if ($sponsorship->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $profil = ProfilYayasan::first();
        $pdf = Pdf::loadView('invoices.sponsorship_pdf', compact('sponsorship', 'profil'));
        return $pdf->download('invoice-sponsorship-'.$sponsorship->order_id.'.pdf');
    }

    // --- DOWNLOAD PDF LAPORAN PERKEMBANGAN: generate PDF laporan perkembangan anak, auto-rotate foto sesuai EXIF, return download ---
    public function childDevelopmentPdf($id)
    {
        $development = ChildDevelopment::with(['fosterChild', 'sponsorship'])->findOrFail($id);

        if ($development->sponsorship?->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $profil = ProfilYayasan::first();
        $fotoPath = null;

        if ($development->foto) {
            $original = storage_path('app/public/' . $development->foto);
            if (file_exists($original)) {
                $info = pathinfo($original);
                $ext = strtolower($info['extension'] ?? 'jpg');
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $fotoPath = $this->autoRotateImage($original, $ext);
                }
            }
        }

        $pdf = Pdf::loadView('invoices.child_development_pdf', compact('development', 'profil', 'fotoPath'));
        $pdf->setPaper('A4', 'portrait');

        $response = $pdf->download('laporan-perkembangan-'.($development->fosterChild?->name ?? 'anak').'-'.$development->id.'.pdf');

        if ($fotoPath && file_exists($fotoPath)) {
            @unlink($fotoPath);
        }

        return $response;
    }

    private function autoRotateImage(string $path, string $ext): ?string
    {
        try {
            if (!function_exists('exif_read_data')) {
                return null;
            }

            $exif = @exif_read_data($path);
            $orientation = $exif['Orientation'] ?? 1;

            if ($orientation === 1) {
                return null;
            }

            switch ($ext) {
                case 'jpg':
                case 'jpeg':
                    $img = @imagecreatefromjpeg($path);
                    break;
                case 'png':
                    $img = @imagecreatefrompng($path);
                    break;
                case 'gif':
                    $img = @imagecreatefromgif($path);
                    break;
                case 'webp':
                    $img = @imagecreatefromwebp($path);
                    break;
                default:
                    return null;
            }

            if (!$img) {
                return null;
            }

            switch ($orientation) {
                case 3:
                    $img = imagerotate($img, 180, 0);
                    break;
                case 6:
                    $img = imagerotate($img, -90, 0);
                    break;
                case 8:
                    $img = imagerotate($img, 90, 0);
                    break;
                default:
                    imagedestroy($img);
                    return null;
            }

            $tmpDir = storage_path('app/tmp');
            if (!is_dir($tmpDir)) {
                @mkdir($tmpDir, 0755, true);
            }

            $tmpPath = $tmpDir . '/foto_' . uniqid() . '.' . $ext;

            switch ($ext) {
                case 'jpg':
                case 'jpeg':
                    imagejpeg($img, $tmpPath, 90);
                    break;
                case 'png':
                    imagepng($img, $tmpPath);
                    break;
                case 'gif':
                    imagegif($img, $tmpPath);
                    break;
                case 'webp':
                    imagewebp($img, $tmpPath);
                    break;
            }

            imagedestroy($img);
            return $tmpPath;

        } catch (\Exception $e) {
            return null;
        }
    }
}
