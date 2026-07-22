<?php
// === SponsorshipController (Admin): mengelola data sponsorship dan kontak anak asuh ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\FosterChild;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    // --- DAFTAR SPONSORSHIP: menampilkan semua data sponsorship dengan pagination ---
    public function index()
    {
        $sponsorships = Sponsorship::with('fosterChild')->latest()->paginate(50);

        return view('admin.sponsorships.index', compact('sponsorships'));
    }

    // --- SETUJUI SPONSORSHIP: update status jadi success, set starts_at/expires_at, ubah status anak jadi 'Diasuh', redirect back ---
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
}