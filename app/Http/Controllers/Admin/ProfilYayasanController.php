<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilYayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilYayasanController extends Controller
{
    // 1. Tampilkan Halaman Profil
    public function index()
    {
        $profil = ProfilYayasan::first();
        return view('admin.profil.index', compact('profil'));
    }

    // 2. Tampilkan Form Edit / Buat Profil
    public function edit()
    {
        $profil = ProfilYayasan::first();
        return view('admin.profil.edit', compact('profil'));
    }

    // 3. Simpan atau Update Data dari Form
    // 3. Simpan atau Update Data dari Form
    public function update(Request $request)
    {
        // Tambahin validasi buat file upload Legalitas & Struktur, serta Visi Misi
        $request->validate([
            'nama_yayasan'    => 'required|string|max:255',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat'          => 'required|string',
            'no_telp'         => 'required|string',
            'email'           => 'required|email',
            'sejarah_yayasan' => 'required',
            'visi'            => 'required|string', // Tambahan Validasi Visi
            'misi'            => 'required|string', // Tambahan Validasi Misi
            'legalitas'       => 'nullable|string', 
            'foto_legalitas'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // maks 2MB
            'foto_struktur'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // maks 2MB
        ]);

        $profil = ProfilYayasan::first();
        
        // Pisahin file dari data teks (Otomatis menyertakan visi & misi karena tidak dikecualikan)
        $data = $request->except(['logo', 'foto_legalitas', 'foto_struktur']); 

        // Upload Logo
        if ($request->hasFile('logo')) {
            if ($profil && $profil->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo', 'public');
        }

        // Upload Foto Legalitas
        if ($request->hasFile('foto_legalitas')) {
            if ($profil && $profil->foto_legalitas) {
                Storage::disk('public')->delete($profil->foto_legalitas);
            }
            $data['foto_legalitas'] = $request->file('foto_legalitas')->store('legalitas', 'public');
        }

        // Upload Foto Struktur Pengurus
        if ($request->hasFile('foto_struktur')) {
            if ($profil && $profil->foto_struktur) {
                Storage::disk('public')->delete($profil->foto_struktur);
            }
            $data['foto_struktur'] = $request->file('foto_struktur')->store('struktur', 'public');
        }

        // Simpan ke database
        ProfilYayasan::updateOrCreate(['id' => $profil ? $profil->id : null], $data);

        return redirect()->route('admin.profil.index')->with('success', 'Profil Yayasan beserta gambar berhasil diperbarui!');
    }
}