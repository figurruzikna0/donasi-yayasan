<?php
// === EmailVerificationNotificationController: mengirim ulang notifikasi verifikasi email ===

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    // --- KIRIM ULANG EMAIL VERIFIKASI: kirim notifikasi verifikasi baru, redirect back dengan status ---
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended($this->dashboardRoute());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
