<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    public function dashboard()
    {
        // Tarik data donasi khusus untuk user yang lagi login
        $donations = Donation::with('campaign')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Lempar datanya ke tampilan dashboard bawaan Breeze
        return view('dashboard', compact('donations'));
    }
}