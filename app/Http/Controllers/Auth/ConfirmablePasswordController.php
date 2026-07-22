<?php
// === ConfirmablePasswordController: konfirmasi password untuk akses area sensitif ===

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    // --- TAMPILKAN FORM KONFIRMASI PASSWORD: menampilkan halaman konfirmasi password ---
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    // --- PROSES KONFIRMASI PASSWORD: validasi password user, simpan timestamp konfirmasi di session, redirect ke dashboard ---
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended($this->dashboardRoute());
    }
}
