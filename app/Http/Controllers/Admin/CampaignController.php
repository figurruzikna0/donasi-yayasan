<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Tambahan wajib untuk fitur hapus gambar

class CampaignController extends Controller
{
    // --- FUNGSI INDEX (Menampilkan daftar data) ---
    public function index()
    {
        $campaigns = Campaign::all();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    // --- FUNGSI CREATE (Menampilkan form tambah) ---
    public function create()
    {
        return view('admin.campaigns.create');
    }

    // --- FUNGSI STORE (Menyimpan data baru) ---
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:campaigns,title', 
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:0', 
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campaigns', 'public');
        } else {
            return redirect()->back()->withInput()->withErrors(['image' => 'Gambar gagal diunggah.']);
        }

        Campaign::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'target_amount' => $validated['target_amount'],
            'image' => $imagePath,
            'status' => 'active',
        ]);

        return redirect()->route('admin.campaigns.index')
                         ->with('success', 'Kampanye berhasil ditambahkan!');
    }

    // --- FUNGSI EDIT (Menampilkan form edit) ---
    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    // --- FUNGSI UPDATE (Menyimpan perubahan data) ---
    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            // Pengecualian ID agar judul sendiri tidak dianggap duplikat
            'title' => 'required|string|max:255|unique:campaigns,title,' . $campaign->id, 
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:0', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Boleh kosong jika tidak ganti gambar
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'target_amount' => $validated['target_amount'],
        ];

        // Jika user mengupload gambar baru
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama dari folder public/storage
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            // 2. Simpan gambar baru
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        $campaign->update($data);

        return redirect()->route('admin.campaigns.index')
                         ->with('success', 'Kampanye berhasil diperbarui!');
    }

    // --- FUNGSI DESTROY (Menghapus data dan gambar) ---
    public function destroy(Campaign $campaign)
    {
        // Hapus file gambar dari folder public/storage terlebih dahulu
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }
        
        // Baru hapus data dari database
        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
                         ->with('success', 'Kampanye berhasil dihapus!');
    }
}