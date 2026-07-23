<?php
// === DonorController: menampilkan dashboard dan rekap untuk user role donatur ===

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\ChildDevelopment;
use App\Models\Donation;
use App\Models\FosterChild;
use App\Models\News;
use App\Models\Pendiri;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    // --- DASHBOARD DONATUR: menampilkan data campaign, anak asuh, donasi, sponsorship, total donasi, dan statistik ---
    public function dashboard()
    {
        $user = Auth::user();

        $pendiris = Pendiri::latest()->get();
        $newsList = News::published()->latest('tanggal_kegiatan')->take(6)->get();
        $campaigns = Campaign::where('status', 'active')->latest()->get();
        $sponsoredChildIds = Sponsorship::where('user_id', $user->id)
            ->where('status', 'success')
            ->pluck('foster_child_id');

        $usia = request('usia');
        $jenisKelamin = request('jenis_kelamin');

        $fosterChildrenQuery = FosterChild::where(function ($q) use ($sponsoredChildIds) {
            $q->where('status', 'Tersedia')
              ->orWhereIn('id', $sponsoredChildIds);
        });

        $totalVisible = $fosterChildrenQuery->count();

        $fosterChildren = $fosterChildrenQuery
            ->when($usia, fn($q, $usia) => $q->whereBetween('age', explode('-', $usia)))
            ->when($jenisKelamin, fn($q, $v) => $q->where('jenis_kelamin', $v))
            ->latest()
            ->get();

        $totalFoster = FosterChild::count();
        $tersediaFoster = FosterChild::where('status', 'Tersedia')->count();
        $diasuhFoster = $sponsoredChildIds->count();

        $donations = Donation::with('campaign')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $sponsorships = Sponsorship::with('fosterChild')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $totalDonated = Donation::where('user_id', $user->id)
            ->where('status', 'success')
            ->sum('amount');

        $activeSponsorships = Sponsorship::where('user_id', $user->id)
            ->where('status', 'success')
            ->count();

        return view('dashboard', compact(
            'pendiris', 'newsList', 'campaigns', 'fosterChildren',
            'donations', 'sponsorships', 'totalDonated', 'activeSponsorships', 'user',
            'totalFoster', 'tersediaFoster', 'diasuhFoster', 'totalVisible'
        ));
    }

    // --- REKAP DONATUR: menampilkan riwayat donasi, sponsorship, dan laporan perkembangan anak untuk user yang login ---
    public function rekap()
    {
        $user = Auth::user();

        $donations = Donation::with('campaign')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $sponsorships = Sponsorship::with('fosterChild')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $childDevelopments = ChildDevelopment::whereHas('sponsorship', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with(['fosterChild', 'sponsorship'])
            ->latest('tanggal')
            ->get();

        return view('dashboard.rekap', compact(
            'donations', 'sponsorships', 'childDevelopments', 'user'
        ));
    }
}
