<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\ChildDevelopment;
use App\Models\Donation;
use App\Models\FosterChild;
use App\Models\News;
use App\Models\Pendiri;
use App\Models\ProfilYayasan;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $profil = ProfilYayasan::first();
        $pendiris = Pendiri::latest()->get();
        $newsList = News::published()->latest('tanggal_kegiatan')->take(6)->get();
        $campaigns = Campaign::where('status', 'active')->latest()->get();
        $sponsoredChildIds = Sponsorship::where('user_id', $user->id)
            ->where('status', 'success')
            ->pluck('foster_child_id');

        $fosterChildren = FosterChild::where(function ($q) use ($sponsoredChildIds) {
                $q->where('status', 'Tersedia')
                  ->orWhereIn('id', $sponsoredChildIds);
            })
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
            'profil', 'pendiris', 'newsList', 'campaigns', 'fosterChildren',
            'donations', 'sponsorships', 'totalDonated', 'activeSponsorships', 'user',
            'totalFoster', 'tersediaFoster', 'diasuhFoster'
        ));
    }

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
