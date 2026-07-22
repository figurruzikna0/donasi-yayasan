<?php
// === PendiriController (Admin): mengelola data anggota pendiri yayasan ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendiri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendiriController extends Controller
{
    // --- DAFTAR PENDIRI: menampilkan semua data pendiri dengan pagination ---
    public function index()
    {
        $pendiris = Pendiri::latest()->paginate(10);
        return view('admin.pendiri.index', compact('pendiris'));
    }

    // --- TAMBAH PENDIRI BARU: validasi input, upload foto, simpan ke DB, redirect back dengan pesan sukses ---
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan', 'deskripsi']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pendiri', 'public');
        }

        Pendiri::create($data);

        return back()->with('success', 'Anggota Pendiri berhasil ditambahkan!');
    }

    // --- HAPUS PENDIRI: hapus foto dari storage, hapus data pendiri, redirect back ---
    public function destroy($id)
    {
        $pendiri = Pendiri::findOrFail($id);
        
        if ($pendiri->foto) {
            Storage::disk('public')->delete($pendiri->foto);
        }
        
        $pendiri->delete();

        return back()->with('success', 'Data pendiri berhasil dihapus!');
    }
}