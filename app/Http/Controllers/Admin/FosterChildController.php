<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FosterChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FosterChildController extends Controller
{
    // 1. Daftar anak asuh
    public function index()
    {
        $children = FosterChild::latest()->get();
        return view('admin.foster_children.index', compact('children'));
    }

    // 2. Form tambah
    public function create()
    {
        return view('admin.foster_children.create');
    }

    // 3. Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'age'         => 'required|integer|min:0',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'      => 'nullable|string|max:50',
        ]);

        $data = $request->only(['name', 'age', 'description', 'status']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('foster_children', 'public');
        }

        FosterChild::create($data);

        return redirect()
            ->route('admin.foster-children.index')
            ->with('success', 'Data Anak Asuh berhasil ditambahkan!');
    }

    // 4. Detail (opsional, dibutuhkan resource route)
    public function show(FosterChild $fosterChild)
    {
        return redirect()->route('admin.foster-children.edit', $fosterChild);
    }

    // 5. ★ Form edit ★
    public function edit(FosterChild $fosterChild)
    {
        return view('admin.foster_children.edit', compact('fosterChild'));
    }

    // 6. ★ Simpan perubahan ★
    public function update(Request $request, FosterChild $fosterChild)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'age'         => 'required|integer|min:0',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'      => 'nullable|string|max:50',
        ]);

        $data = $request->only(['name', 'age', 'description', 'status']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama kalau ada
            if ($fosterChild->photo) {
                Storage::disk('public')->delete($fosterChild->photo);
            }
            $data['photo'] = $request->file('photo')->store('foster_children', 'public');
        }

        $fosterChild->update($data);

        return redirect()
            ->route('admin.foster-children.index')
            ->with('success', 'Data Anak Asuh berhasil diperbarui!');
    }

    // 7. Hapus data
    public function destroy(FosterChild $fosterChild)
    {
        if ($fosterChild->photo) {
            Storage::disk('public')->delete($fosterChild->photo);
        }

        $fosterChild->delete();

        return redirect()
            ->back()
            ->with('success', 'Data Anak Asuh berhasil dihapus!');
    }
}