<?php
// === AuthenticatedSessionController: menangani login session user ===

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // --- TAMPILKAN FORM LOGIN: menampilkan halaman login ---
    public function create(): View
    {
        return view('auth.login');
    }

    // --- PROSES LOGIN: autentikasi via LoginRequest, regenerate session, redirect ke admin/dashboard atau /dashboard sesuai role ---
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/dashboard');
    }

    // --- LOGOUT: logout user, invalidate session, regenerate token, redirect ke home ---
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
