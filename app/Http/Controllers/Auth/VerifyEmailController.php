<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $user = User::findOrFail($request->route('id'));

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect($this->dashboardRouteByRole($user) . '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        if (! $request->user()) {
            auth()->login($user);
        }

        return redirect($this->dashboardRouteByRole($user) . '?verified=1');
    }

    private function dashboardRouteByRole(User $user): string
    {
        return $user->role === 'admin' ? '/admin/dashboard' : '/dashboard';
    }
}
