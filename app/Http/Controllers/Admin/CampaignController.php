<?php
// === CampaignController (Admin): CRUD kampanye donasi ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Traits\HandlesFileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    use HandlesFileUpload;

    // --- DAFTAR KAMPANYE: menampilkan semua data kampanye ---
    public function index()
    {
        $campaigns = Campaign::all();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    // --- FORM TAMBAH KAMPANYE: menampilkan halaman tambah kampanye baru ---
    public function create()
    {
        return view('admin.campaigns.create');
    }

    // --- PROSES TAMBAH KAMPANYE: validasi input, upload image, generate slug, simpan status active, redirect ke daftar kampanye ---
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:campaigns,title',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        Campaign::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'target_amount' => $validated['target_amount'],
            'image' => $this->uploadFile($request->file('image'), 'campaigns'),
            'status' => 'active',
        ]);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Kampanye berhasil ditambahkan!');
    }

    // --- DETAIL KAMPANYE: menampilkan halaman detail kampanye ---
    public function show(Campaign $campaign)
    {
        return view('admin.campaigns.show', compact('campaign'));
    }

    // --- FORM EDIT KAMPANYE: menampilkan halaman edit kampanye ---
    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    // --- PROSES UPDATE KAMPANYE: validasi input, upload image jika ada, update slug, redirect ke daftar kampanye ---
    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:campaigns,title,' . $campaign->id,
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'target_amount' => $validated['target_amount'],
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile(
                $request->file('image'),
                'campaigns',
                $campaign->image
            );
        }

        $campaign->update($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Kampanye berhasil diperbarui!');
    }

    // --- HAPUS KAMPANYE: hapus data kampanye, redirect ke daftar kampanye ---
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Kampanye berhasil dihapus!');
    }
}
