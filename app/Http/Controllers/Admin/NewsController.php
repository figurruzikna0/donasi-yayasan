<?php
// === NewsController (Admin): CRUD berita/kegiatan yayasan ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Traits\HandlesFileUpload;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use HandlesFileUpload;

    // --- DAFTAR BERITA: menampilkan semua berita dengan pagination ---
    public function index()
    {
        $newsList = News::latest()->paginate(10);
        return view('admin.news.index', compact('newsList'));
    }

    // --- FORM TAMBAH BERITA: menampilkan halaman tambah berita baru ---
    public function create()
    {
        return view('admin.news.create');
    }

    // --- PROSES TAMBAH BERITA: validasi input, generate slug, upload foto, simpan ke DB, redirect ke daftar berita ---
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|string|max:100',
            'tanggal_kegiatan' => 'required|date',
            'lokasi'           => 'nullable|string|max:255',
            'penyelenggara'    => 'nullable|string|max:255',
            'ringkasan'        => 'nullable|string|max:500',
            'konten'           => 'required|string',
            'foto_utama'       => 'nullable|image|max:3072',
            'status'           => 'required|in:draft,published',
        ]);

        $validated['slug'] = News::generateSlug($validated['judul']);

        if ($request->hasFile('foto_utama')) {
            $validated['foto_utama'] = $this->uploadFile($request->file('foto_utama'), 'news');
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita kegiatan berhasil ditambahkan!');
    }

    // --- DETAIL BERITA: menampilkan halaman detail berita ---
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    // --- FORM EDIT BERITA: menampilkan halaman edit berita ---
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    // --- PROSES UPDATE BERITA: validasi input, upload foto jika ada, update slug jika judul berubah, redirect ke daftar berita ---
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|string|max:100',
            'tanggal_kegiatan' => 'required|date',
            'lokasi'           => 'nullable|string|max:255',
            'penyelenggara'    => 'nullable|string|max:255',
            'ringkasan'        => 'nullable|string|max:500',
            'konten'           => 'required|string',
            'foto_utama'       => 'nullable|image|max:3072',
            'status'           => 'required|in:draft,published',
        ]);

        if ($validated['judul'] !== $news->judul) {
            $validated['slug'] = News::generateSlug($validated['judul']);
        }

        if ($request->hasFile('foto_utama')) {
            $validated['foto_utama'] = $this->uploadFile(
                $request->file('foto_utama'),
                'news',
                $news->foto_utama
            );
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita kegiatan berhasil diperbarui!');
    }

    // --- HAPUS BERITA: hapus data berita, redirect ke daftar berita ---
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita kegiatan berhasil dihapus.');
    }
}
