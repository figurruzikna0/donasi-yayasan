<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\FosterChild;
use App\Models\Sponsorship;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFunds = Donation::where('status', 'success')->sum('amount');
        $activeCampaigns = Campaign::where('status', 'active')->count();
        $fosterChildren = FosterChild::count();

        // Top campaigns by collected amount
        $topCampaigns = Campaign::where('status', 'active')
            ->orderByDesc('collected_amount')
            ->take(5)
            ->get();

        // Today & month stats
        $todayDonasi = Donation::where('status', 'success')
            ->whereDate('created_at', today())->sum('amount');

        $monthSponsor = Sponsorship::where('status', 'success')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $pendingCount = Donation::where('status', 'pending')->count()
            + Sponsorship::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalFunds', 'activeCampaigns', 'fosterChildren',
            'topCampaigns', 'todayDonasi', 'monthSponsor', 'pendingCount'
        ));
    }
}
