<?php
// === SponsorshipController (Admin): mengelola data sponsorship dan kontak anak asuh ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\FosterChild;
use App\Models\Sponsorship;
use App\Services\FonnteService;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    // --- DAFTAR SPONSORSHIP: menampilkan semua data sponsorship dengan pagination ---
    public function index()
    {
        $sponsorships = Sponsorship::with('fosterChild')->latest()->paginate(50);

        return view('admin.sponsorships.index', compact('sponsorships'));
    }

    // --- SETUJUI SPONSORSHIP: update status jadi success, set starts_at/expires_at, ubah status anak jadi 'Diasuh', kirim WA, redirect back ---
    public function approve($id)
    {
        $sponsorship = Sponsorship::where('order_id', $id)->first();

        if (! $sponsorship) {
            return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
        }

        $sponsorship->update([
            'status' => 'success',
            'starts_at' => $sponsorship->starts_at ?? now(),
            'expires_at' => $sponsorship->expires_at ?? now()->addMonth(),
        ]);

        $sponsorship->fosterChild?->update(['status' => 'Diasuh']);

        if ($sponsorship->donor_phone) {
            $this->kirimWaSponsor($sponsorship);
        }

        return redirect()->back()->with('success', 'Sponsorship berhasil disetujui!');
    }

    // --- HAPUS SPONSORSHIP: hapus data sponsorship berdasarkan order_id, redirect back ---
    public function destroy($id)
    {
        $sponsorship = Sponsorship::where('order_id', $id)->first();

        if (! $sponsorship) {
            return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
        }

        $sponsorship->delete();

        return redirect()->back()->with('success', 'Data sponsorship berhasil dihapus!');
    }

    // --- KONTAK ANAK ASUH: menampilkan daftar anak asuh dengan sponsorship aktif dan jumlah transaksi pending ---
    public function contacts()
    {
        $children = FosterChild::with('activeSponsorship')->orderBy('name')->get();

        $pendingCount = Donation::where('status', 'pending')->count()
            + Sponsorship::where('status', 'pending')->count();

        return view('admin.sponsorships.contacts', compact('children', 'pendingCount'));
    }

    private function kirimWaSponsor(Sponsorship $sponsorship): void
    {
        $child   = $sponsorship->fosterChild;
        $fonnte  = new FonnteService();

        $namaAnak    = $child?->name        ?? 'anak asuh';
        $usiaAnak    = $child?->age         ? $child->age . ' tahun' : '-';
        $paket       = $sponsorship->package ?? '-';
        $nominal     = 'Rp ' . number_format($sponsorship->amount, 0, ',', '.');
        $mulai       = $sponsorship->starts_at
                         ? \Carbon\Carbon::parse($sponsorship->starts_at)->translatedFormat('d F Y')
                         : now()->translatedFormat('d F Y');
        $berakhir    = $sponsorship->expires_at
                         ? \Carbon\Carbon::parse($sponsorship->expires_at)->translatedFormat('d F Y')
                         : now()->addMonth()->translatedFormat('d F Y');
        $orderId     = $sponsorship->order_id;
        $donatur     = $sponsorship->donor_name;

        $pesan = "Assalamu'alaikum, *{$donatur}* 🌿\n\n"
               . "✅ *Sponsorship Anak Asuh Berhasil Dikonfirmasi!*\n\n"
               . "Terima kasih telah menjadi Orang Tua Asuh. Kepedulian Anda sangat berarti bagi masa depan anak-anak kami. 🤲\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "👦 *Data Anak Asuh*\n"
               . "Nama   : {$namaAnak}\n"
               . "Usia   : {$usiaAnak}\n\n"
               . "📦 *Rincian Paket*\n"
               . "Paket  : {$paket}\n"
               . "Nominal: {$nominal}\n"
               . "Berlaku: {$mulai} s/d {$berakhir}\n\n"
               . "🆔 *ID Transaksi*\n"
               . "{$orderId}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Semoga Allah SWT membalas kebaikan Anda dengan berlipat ganda. Aamiin 🤍\n\n"
               . "_Baitul Yatim_";

        $fonnte->send($sponsorship->donor_phone, $pesan);
    }
}