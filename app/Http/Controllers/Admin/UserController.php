<?php
// === UserController (Admin): mengelola data user (donatur & admin) ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // --- DAFTAR USER: menampilkan semua user donatur (paginate) dan admin ---
    public function index()
    {
        $donaturs = User::where('role', 'donatur')->latest()->paginate(20);
        $admins = User::where('role', 'admin')->latest()->get();
        return view('admin.users.index', compact('donaturs', 'admins'));
    }

    // --- FORM EDIT USER: menampilkan halaman edit data user berdasarkan id ---
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // --- PROSES UPDATE USER: validasi input, update data user, redirect ke daftar user dengan pesan sukses ---
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'nik' => 'nullable|string|max:20',
            'role' => 'required|in:admin,donatur',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'address', 'nik', 'role']));

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    // --- HAPUS USER: cegah hapus admin, hapus user donatur, redirect ke daftar user dengan pesan sukses ---
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak bisa menghapus akun admin.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
