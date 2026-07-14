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

        $topCampaigns = Campaign::where('status', 'active')
            ->orderByDesc('collected_amount')
            ->take(5)
            ->get();

        $todayDonasi = Donation::where('status', 'success')
            ->whereDate('created_at', today())->sum('amount');

        $monthSponsor = Sponsorship::where('status', 'success')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $pendingCount = Donation::where('status', 'pending')->count()
            + Sponsorship::where('status', 'pending')->count();

        // ── Transaksi terbaru (sebelumnya di Blade @php) ──
        $recentDonations = Donation::with('campaign')
            ->latest()->take(4)->get();

        // ── Statistik anak asuh (sebelumnya di Blade @php) ──
        $totalAnak   = FosterChild::count();
        $tersedia    = FosterChild::where('status', 'Tersedia')->count();
        $diasuh      = FosterChild::where('status', 'Diasuh')->count();
        $lainnya     = $totalAnak - $tersedia - $diasuh;

        // ── Cashflow 12 bulan: 1 query GROUP BY (sebelumnya 12 query terpisah) ──
        $rawCashflow = Donation::where('status', 'success')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(fn($i) => $i->year . '-' . str_pad($i->month, 2, '0', STR_PAD_LEFT));

        $labels12  = [];
        $cashflow12 = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $key  = $date->year . '-' . str_pad($date->month, 2, '0', STR_PAD_LEFT);
            $labels12[]  = $date->locale('id')->isoFormat('MMM YY');
            $cashflow12[] = (int) ($rawCashflow[$key]->total ?? 0);
        }

        return view('admin.dashboard', compact(
            'totalFunds', 'activeCampaigns', 'fosterChildren',
            'topCampaigns', 'todayDonasi', 'monthSponsor', 'pendingCount',
            'recentDonations', 'totalAnak', 'tersedia', 'diasuh', 'lainnya',
            'labels12', 'cashflow12',
        ));
    }
}
