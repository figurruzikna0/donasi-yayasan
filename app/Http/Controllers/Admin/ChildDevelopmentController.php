<?php

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
    // Daftar semua laporan perkembangan
    public function index()
    {
        $developments = ChildDevelopment::with(['fosterChild', 'sponsorship', 'user'])
            ->latest('tanggal')
            ->paginate(10);

        return view('admin.child-developments.index', compact('developments'));
    }

    // Form tambah laporan baru
    public function create()
    {
        $children = FosterChild::where('status', 'Diasuh')->get();
        return view('admin.child-developments.create', compact('children'));
    }

    // Simpan laporan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'foster_child_id' => 'required|exists:foster_children,id',
            'tanggal'         => 'required|date',
            'judul'           => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'foto'            => 'nullable|image|max:3072',
        ]);

        // Cari sponsorship aktif untuk anak ini
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
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('child-developments', 'public');
        }

        $development = ChildDevelopment::create($validated);

        // ✅ Kirim notifikasi WA ke orang tua asuh
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

    // Form edit
    public function edit(ChildDevelopment $childDevelopment)
    {
        $children = FosterChild::where('status', 'Diasuh')->get();
        return view('admin.child-developments.edit', [
            'development' => $childDevelopment,
            'children'    => $children,
        ]);
    }

    // Update laporan
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

    // Hapus laporan
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
        $namaOTA   = $sponsorship->donor_name;
        $tanggal   = $development->tanggal->translatedFormat('d F Y');
        $judul     = $development->judul;
        $deskripsi = $development->deskripsi;

        $pesan = "Assalamu'alaikum, *{$namaOTA}* 🌿\n\n"
               . "📋 *Laporan Perkembangan Anak Asuh Anda*\n\n"
               . "Alhamdulillah, ada update terbaru tentang anak yang Anda sponsori. Berikut laporannya:\n\n"
               . "━━━━━━━━━━━━━━━━━\n"
               . "👦 *Nama Anak* : {$namaAnak}\n"
               . "🗓 *Tanggal*   : {$tanggal}\n\n"
               . "📌 *{$judul}*\n\n"
               . "{$deskripsi}\n"
               . "━━━━━━━━━━━━━━━━━\n\n"
               . "Terima kasih atas kepedulian dan dukungan Anda yang berkelanjutan. Semoga menjadi amal jariyah yang terus mengalir. 🤲\n\n"
               . "_Baitul Yatim_";

        $fonnte->send($sponsorship->donor_phone, $pesan);

        // Kalau ada foto, kirim juga sebagai pesan terpisah (Fonnte butuh endpoint berbeda untuk media)
        if ($development->foto) {
            $this->kirimWaFoto($sponsorship->donor_phone, $development->foto);
        }
    }

    // ── Private: kirim foto laporan via Fonnte (endpoint media) ──
    private function kirimWaFoto(string $phone, string $fotoPath): void
    {
        try {
            $url = asset('storage/' . $fotoPath);

            \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => config('services.fonnte.token'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'url'    => $url,
                'message' => '📸 Foto perkembangan anak asuh Anda',
            ]);

        } catch (\Throwable $e) {
            Log::error('Gagal kirim foto WA: ' . $e->getMessage());
        }
    }
}