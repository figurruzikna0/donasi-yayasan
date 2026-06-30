<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilYayasan;
use App\Models\Pendiri; // 👈 Tambahin ini biar kenal sama tabel Pendiri
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilYayasanController extends Controller
{
    // 1. Tampilkan Halaman Profil + Data Pendiri
    public function index()
    {
        $profil = ProfilYayasan::first();
        $pendiris = Pendiri::latest()->get(); // 👈 Ambil semua data pendiri
        
        // Lempar dua-duanya ke halaman view
        return view('admin.profil.index', compact('profil', 'pendiris'));
    }

    // 2. Tampilkan Form Edit / Buat Profil
    public function edit()
    {
        $profil = ProfilYayasan::first();
        return view('admin.profil.edit', compact('profil'));
    }

    // 3. Simpan atau Update Data dari Form
    public function update(Request $request)
    {
        $request->validate([
            'nama_yayasan'    => 'required|string|max:255',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat'          => 'required|string',
            'no_telp'         => 'required|string',
            'email'           => 'required|email',
            'sejarah_yayasan' => 'required',
            'visi'            => 'required|string', 
            'misi'            => 'required|string', 
            'legalitas'       => 'nullable|string', 
            'foto_legalitas'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_struktur'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profil = ProfilYayasan::first();
        
        $data = $request->except(['logo', 'foto_legalitas', 'foto_struktur']); 

        if ($request->hasFile('logo')) {
            if ($profil && $profil->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo', 'public');
        }

        if ($request->hasFile('foto_legalitas')) {
            if ($profil && $profil->foto_legalitas) {
                Storage::disk('public')->delete($profil->foto_legalitas);
            }
            $data['foto_legalitas'] = $request->file('foto_legalitas')->store('legalitas', 'public');
        }

        if ($request->hasFile('foto_struktur')) {
            if ($profil && $profil->foto_struktur) {
                Storage::disk('public')->delete($profil->foto_struktur);
            }
            $data['foto_struktur'] = $request->file('foto_struktur')->store('struktur', 'public');
        }

        ProfilYayasan::updateOrCreate(['id' => $profil ? $profil->id : null], $data);

        return redirect()->route('admin.profil.index')->with('success', 'Profil Yayasan beserta gambar berhasil diperbarui!');
    }
}