<?php
// === ProfileController: menangani edit profil user, upload avatar, dan hapus akun ===

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Traits\HandlesFileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use HandlesFileUpload;

    // --- TAMPILKAN FORM EDIT PROFIL: menampilkan halaman edit profil untuk user yang sedang login ---
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // --- PROSES UPDATE PROFIL: validasi input, upload/remove avatar jika ada, redirect ke form edit dengan status ---
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->uploadFile(
                $request->file('avatar'),
                'avatars',
                $user->avatar
            );
        } elseif ($request->input('remove_avatar') === '1') {
            $this->deleteFile($user->avatar);
            $data['avatar'] = null;
        } else {
            unset($data['avatar']);
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // --- HAPUS AKUN: validasi password, logout, hapus user, invalidate session, redirect ke home ---
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
