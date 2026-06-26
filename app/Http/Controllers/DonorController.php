<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
// Ini kita tambahin biar controllernya kenal sama model ProfilYayasan
use App\Models\ProfilYayasan; 

class DonorController extends Controller
{
    public function dashboard()
    {
        // Tarik data donasi khusus untuk user yang lagi login (Asli bawaan temen lu)
        $donations = Donation::with('campaign')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Tarik data profil yayasan (Tambahan baru dari kita)
        $profil = ProfilYayasan::first();

        // Lempar datanya ke tampilan dashboard bawaan Breeze (Kita tambahin 'profil' di dalam compact)
        return view('dashboard', compact('donations', 'profil'));
    }
}