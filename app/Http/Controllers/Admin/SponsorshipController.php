<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\FosterChild;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function index()
    {
        $sponsorships = Sponsorship::with('fosterChild')->latest()->get();

        return view('admin.sponsorships.index', compact('sponsorships'));
    }

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

    public function destroy($id)
    {
        $sponsorship = Sponsorship::where('order_id', $id)->first();

        if (! $sponsorship) {
            return redirect()->back()->with('error', 'Data sponsorship tidak ditemukan.');
        }

        $sponsorship->delete();

        return redirect()->back()->with('success', 'Data sponsorship berhasil dihapus!');
    }

    public function contacts()
    {
        $children = FosterChild::with('activeSponsorship')->orderBy('name')->get();

        $pendingCount = Donation::where('status', 'pending')->count()
            + Sponsorship::where('status', 'pending')->count();

        return view('admin.sponsorships.contacts', compact('children', 'pendingCount'));
    }
}