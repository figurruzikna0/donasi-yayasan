<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\ProfilYayasan;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function donation($id)
    {
        $donation = Donation::with('campaign')->findOrFail($id);

        if ($donation->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $profil = ProfilYayasan::first();
        return view('invoices.donation', compact('donation', 'profil'));
    }

    public function sponsorship($id)
    {
        $sponsorship = Sponsorship::with('fosterChild')->findOrFail($id);

        if ($sponsorship->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $profil = ProfilYayasan::first();
        return view('invoices.sponsorship', compact('sponsorship', 'profil'));
    }
}
