<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    // Daftar semua berita
    public function index()
    {
        $newsList = News::latest()->paginate(10);
        return view('admin.news.index', compact('newsList'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.news.create');
    }

    // Simpan berita baru
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
            $validated['foto_utama'] = $request->file('foto_utama')
                ->store('news', 'public');
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita kegiatan berhasil ditambahkan!');
    }

    // Detail berita
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    // Form edit
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    // Update berita
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
            if ($news->foto_utama) {
                Storage::disk('public')->delete($news->foto_utama);
            }
            $validated['foto_utama'] = $request->file('foto_utama')
                ->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita kegiatan berhasil diperbarui!');
    }

    // Hapus berita
    public function destroy(News $news)
    {
        if ($news->foto_utama) {
            Storage::disk('public')->delete($news->foto_utama);
        }
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita kegiatan berhasil dihapus.');
    }
}