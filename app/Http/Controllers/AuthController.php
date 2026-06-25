<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Nampilin Halaman Form Login
    public function showLoginForm()
    {
        // Ganti 'auth.login' dengan lokasi file blade form login lu yang sekarang ada
        return view('auth.login'); 
    }

    // 2. Mesin Pintu Pintar (Ngecek Siapa yang Login)
    public function authenticate(Request $request)
    {
        // Kita pakai email untuk login (standar keamanan Laravel)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kecocokan data dengan yang ada di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // PINTU PINTAR BEKERJA DI SINI
            if (Auth::user()->role === 'admin') {
                // Kalau dia Admin, lempar ke Dashboard Admin
                return redirect()->intended('/admin/transactions'); 
            }

            // Kalau dia Donatur, lempar ke Beranda/Dashboard Donatur
            return redirect()->intended('/donatur/dashboard'); 
        }

        // Kalau email/password salah, tendang balik ke form login
        return back()->withErrors([
            'email' => 'Email atau password salah, Bro!',
        ])->onlyInput('email');
    }

    // 3. Mesin Logout (Keluar)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}