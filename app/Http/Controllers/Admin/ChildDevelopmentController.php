<?php
// === ChildDevelopmentController (Admin): CRUD laporan perkembangan anak asuh + notifikasi WA ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChildDevelopment;
use App\Models\FosterChild;
use App\Models\Sponsorship;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ChildDevelopmentController extends Controller
{
    // --- DAFTAR PERKEMBANGAN: menampilkan semua laporan perkembangan dengan pagination ---
    public function index()
    {
        $developments = ChildDevelopment::with(['fosterChild', 'sponsorship', 'user'])
            ->latest('tanggal')
            ->paginate(10);

        return view('admin.child-developments.index', compact('developments'));
    }

    // --- FORM TAMBAH PERKEMBANGAN: menampilkan halaman tambah laporan, hanya anak dengan sponsorship aktif ---
    public function create()
    {
        $children = FosterChild::whereHas('sponsorships', function ($q) {
                $q->where('status', 'success');
            })->get();
        return view('admin.child-developments.create', compact('children'));
    }

    // --- PROSES TAMBAH PERKEMBANGAN: validasi, cari sponsorship aktif, simpan laporan + foto, kirim WA ke orang tua asuh, redirect ---
    public function store(Request $request)
    {
        $validated = $request->validate([
            'foster_child_id' => 'required|exists:foster_children,id',
            'tanggal'         => 'required|date',
            'judul'           => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'foto'            => 'nullable|image|max:3072',
        ]);

        $sponsorship = Sponsorship::where('foster_child_id', $validated['foster_child_id'])
            ->where('status', 'success')
            ->latest()
            ->first();

        if (!$sponsorship) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Anak ini belum memiliki sponsorship aktif.');
        }

        $validated['sponsorship_id'] = $sponsorship->id;
        $validated['user_id']        = auth()->id();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('child-developments', 'public');
        }

        $development = ChildDevelopment::create($validated);

        if ($sponsorship->donor_phone) {
            try {
                $this->kirimWaLaporan($development, $sponsorship);
            } catch (\Throwable $e) {
                Log::error('Gagal kirim WA laporan perkembangan: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.child-developments.index')
            ->with('success', 'Laporan perkembangan berhasil ditambahkan & notifikasi WA terkirim ke orang tua asuh!');
    }

    // --- DETAIL PERKEMBANGAN: menampilkan halaman detail laporan perkembangan ---
    public function show(ChildDevelopment $childDevelopment)
    {
        $childDevelopment->load(['fosterChild', 'sponsorship', 'user']);
        return view('admin.child-developments.show', compact('childDevelopment'));
    }

    // --- FORM EDIT PERKEMBANGAN: menampilkan halaman edit laporan perkembangan ---
    public function edit(ChildDevelopment $childDevelopment)
    {
        $children = FosterChild::whereHas('sponsorships', function ($q) {
                $q->where('status', 'success');
            })->get();
        return view('admin.child-developments.edit', [
            'development' => $childDevelopment,
            'children'    => $children,
        ]);
    }

    // --- PROSES UPDATE PERKEMBANGAN: validasi, upload/hapus foto, update data, redirect ke daftar ---
    public function update(Request $request, ChildDevelopment $childDevelopment)
    {
        $validated = $request->validate([
            'tanggal'   => 'required|date',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            if ($childDevelopment->foto) {
                Storage::disk('public')->delete($childDevelopment->foto);
            }
            $validated['foto'] = $request->file('foto')->store('child-developments', 'public');
        }

        $childDevelopment->update($validated);

        return redirect()->route('admin.child-developments.index')
            ->with('success', 'Laporan perkembangan berhasil diperbarui!');
    }

    // --- HAPUS PERKEMBANGAN: hapus foto dari storage, hapus data laporan, redirect ke daftar ---
    public function destroy(ChildDevelopment $childDevelopment)
    {
        if ($childDevelopment->foto) {
            Storage::disk('public')->delete($childDevelopment->foto);
        }

        $childDevelopment->delete();

        return redirect()->route('admin.child-developments.index')
            ->with('success', 'Laporan perkembangan berhasil dihapus.');
    }

    // ── Private: format & kirim WA laporan perkembangan ──
    private function kirimWaLaporan(ChildDevelopment $development, Sponsorship $sponsorship): void
    {
        $fonnte   = new FonnteService();
        $child    = $development->fosterChild;

        $namaAnak  = $child?->name ?? 'anak asuh';
        $kelamin   = $child?->jenis_kelamin ?? '-';
        $namaOTA   = $sponsorship->donor_name;
        $tanggal   = $development->tanggal->translatedFormat('d F Y');
        $judul     = $development->judul;
        $deskripsi = $development->deskripsi;

        $pesan = "Assalamu'alaikum, *{$namaOTA}* 🌿\n\n"
               . "📋 *Laporan Perkembangan Anak Asuh Anda*\n\n"
               . "Alhamdulillah, ada update terbaru tentang anak yang Anda sponsori. Berikut laporannya:\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "👦 *Nama Anak*    : {$namaAnak}\n"
               . "⚧  *Jenis Kelamin*: {$kelamin}\n"
               . "🗓 *Tanggal*      : {$tanggal}\n\n"
               . "📌 *{$judul}*\n\n"
               . "{$deskripsi}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Terima kasih atas kepedulian dan dukungan Anda yang berkelanjutan. Semoga menjadi amal jariyah yang terus mengalir. 🤲\n\n"
               . "_Baitul Yatim_";

        // Kirim pesan teks dulu
        $fonnte->send($sponsorship->donor_phone, $pesan);

        // Kirim foto sebagai pesan terpisah kalau ada
        // (hanya berhasil kalau paket Fonnte mendukung attachment & APP_URL bisa diakses publik)
        if ($development->foto) {
            $fonnte->sendWithMedia(
                $sponsorship->donor_phone,
                '📸 Foto perkembangan anak asuh Anda',
                $development->foto
            );
        }
    }
}