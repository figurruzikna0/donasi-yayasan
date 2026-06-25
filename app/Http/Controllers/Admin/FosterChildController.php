<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FosterChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Buat fitur hapus foto

class FosterChildController extends Controller
{
    // 1. Nampilin daftar anak asuh
    public function index()
    {
        $children = FosterChild::latest()->get();
        return view('admin.foster_children.index', compact('children'));
    }

    // 2. Nampilin form tambah anak
    public function create()
    {
        return view('admin.foster_children.create');
    }

    // 3. Proses simpan data & upload foto ke database
    public function store(Request $request)
    {
        // Validasi inputan admin
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        $data = $request->all();

        // Kalau admin nge-upload foto, simpan ke folder storage
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('foster_children', 'public');
        }

        // Simpan ke database
        FosterChild::create($data);

        return redirect()->route('admin.foster-children.index')->with('success', 'Data Anak Asuh berhasil ditambahkan!');
    }

    // 4. Proses hapus data & hapus file fotonya
    public function destroy(FosterChild $fosterChild)
    {
        // Kalau ada fotonya, hapus dulu file fisiknya dari folder storage
        if ($fosterChild->photo) {
            Storage::disk('public')->delete($fosterChild->photo);
        }
        
        // Hapus datanya dari database
        $fosterChild->delete();

        return redirect()->back()->with('success', 'Data Anak Asuh berhasil dihapus!');
    }
}