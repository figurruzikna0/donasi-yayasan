<?php
// === FosterChildController (Admin): CRUD data anak asuh ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FosterChild;
use App\Traits\HandlesFileUpload;
use Illuminate\Http\Request;

class FosterChildController extends Controller
{
    use HandlesFileUpload;

    // --- DAFTAR ANAK ASUH: menampilkan semua data anak asuh dengan pagination ---
    public function index()
    {
        $children = FosterChild::latest()->paginate(10);
        $allChildren = FosterChild::all();
        return view('admin.foster_children.index', compact('children', 'allChildren'));
    }

    // --- FORM TAMBAH ANAK ASUH: menampilkan halaman tambah anak asuh baru ---
    public function create()
    {
        return view('admin.foster_children.create');
    }

    // --- PROSES TAMBAH ANAK ASUH: validasi input, upload foto, simpan ke DB, redirect ke daftar anak asuh ---
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'age'           => 'required|integer|min:0',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'description'   => 'nullable|string',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'        => 'nullable|string|max:50',
        ]);

        $data = $request->only(['name', 'age', 'jenis_kelamin', 'description', 'status']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->uploadFile($request->file('photo'), 'foster_children');
        }

        FosterChild::create($data);

        return redirect()
            ->route('admin.foster-children.index')
            ->with('success', 'Data Anak Asuh berhasil ditambahkan!');
    }

    // --- DETAIL ANAK ASUH: menampilkan halaman detail anak asuh ---
    public function show(FosterChild $fosterChild)
    {
        return view('admin.foster_children.show', compact('fosterChild'));
    }

    // --- FORM EDIT ANAK ASUH: menampilkan halaman edit data anak asuh ---
    public function edit(FosterChild $fosterChild)
    {
        return view('admin.foster_children.edit', compact('fosterChild'));
    }

    // --- PROSES UPDATE ANAK ASUH: validasi input, upload foto jika ada, update data, redirect ke daftar anak asuh ---
    public function update(Request $request, FosterChild $fosterChild)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'age'           => 'required|integer|min:0',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'description'   => 'nullable|string',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'        => 'nullable|string|max:50',
        ]);

        $data = $request->only(['name', 'age', 'jenis_kelamin', 'description', 'status']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->uploadFile(
                $request->file('photo'),
                'foster_children',
                $fosterChild->photo
            );
        }

        $fosterChild->update($data);

        return redirect()
            ->route('admin.foster-children.index')
            ->with('success', 'Data Anak Asuh berhasil diperbarui!');
    }

    // --- HAPUS ANAK ASUH: hapus data anak asuh, redirect back ---
    public function destroy(FosterChild $fosterChild)
    {
        $fosterChild->delete();

        return redirect()
            ->back()
            ->with('success', 'Data Anak Asuh berhasil dihapus!');
    }
}
