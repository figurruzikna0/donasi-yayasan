<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilYayasan;
use App\Models\Pendiri;
use App\Traits\HandlesFileUpload;
use Illuminate\Http\Request;

class ProfilYayasanController extends Controller
{
    use HandlesFileUpload;

    public function index()
    {
        $pendiris = Pendiri::latest()->get();

        return view('admin.profil.index', compact('pendiris'));
    }

    public function edit()
    {
        return view('admin.profil.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
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
            'foto_qris'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pendiri_nama' => 'nullable|string|max:255',
            'pendiri_jabatan' => 'required_with:pendiri_nama|string|max:255',
            'pendiri_deskripsi' => 'nullable|string',
            'pendiri_foto' => 'required_with:pendiri_nama|image|max:1024',
        ]);

        $profil = ProfilYayasan::first();

        $data = $request->except(['logo', 'foto_legalitas', 'foto_struktur', 'foto_qris']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadFile(
                $request->file('logo'),
                'logo',
                $profil?->logo
            );
        }

        if ($request->hasFile('foto_legalitas')) {
            $data['foto_legalitas'] = $this->uploadFile(
                $request->file('foto_legalitas'),
                'legalitas',
                $profil?->foto_legalitas
            );
        }

        if ($request->hasFile('foto_struktur')) {
            $data['foto_struktur'] = $this->uploadFile(
                $request->file('foto_struktur'),
                'struktur',
                $profil?->foto_struktur
            );
        }

        if ($request->hasFile('foto_qris')) {
            $data['foto_qris'] = $this->uploadFile(
                $request->file('foto_qris'),
                'qris',
                $profil?->foto_qris
            );
        }

        if ($request->filled('pendiri_nama')) {
            Pendiri::create([
                'nama' => $validated['pendiri_nama'],
                'jabatan' => $validated['pendiri_jabatan'],
                'deskripsi' => $validated['pendiri_deskripsi'] ?? null,
                'foto' => $request->file('pendiri_foto')
                    ->store('pendiri', 'public'),
            ]);
        }

        ProfilYayasan::updateOrCreate(['id' => $profil ? $profil->id : null], $data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Profil Yayasan beserta gambar berhasil diperbarui!');
    }
}
