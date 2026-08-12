<?php

/*
 * CleanupOrphanedFiles — Hapus file sampah di storage
 * =====================================================
 * Command ini memindai semua folder storage/app/public/ dan menghapus file
 * yang TIDAK TERREFERENSI di database.
 *
 * Alur konsep:
 *   1. Setiap folder punya "daftar file yang HARUS ADA" (dari kolom database).
 *   2. Bandingkan dengan file yang BENAR-BENAR ADA di disk.
 *   3. File di disk tapi tidak ada di daftar database = sampah → hapus.
 *
 * Cara pakai:
 *   php artisan storage:cleanup              → preview (hanya tampilkan)
 *   php artisan storage:cleanup --force      → hapus file sungguhan
 *
 * Jadwalkan (opsional):
 *   Schedule::command('storage:cleanup --force')->weekly();
 */

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\ChildDevelopment;
use App\Models\Donation;
use App\Models\FosterChild;
use App\Models\News;
use App\Models\Pendiri;
use App\Models\ProfilYayasan;
use App\Models\Sponsorship;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanupOrphanedFiles extends Command
{
    // --force = flag opsional; tanpa flag command hanya menampilkan preview
    protected $signature = 'storage:cleanup {--force : Benar-benar hapus file}';
    protected $description = 'Hapus file di storage yang tidak terpakai di database';

    // Mapping folder → callback untuk ambil daftar file yg dipakai di DB
    // INI JANTUNGNYA COMMAND: setiap folder storage dipetakan ke "sumber kebenaran" di database.
    // Callback mengembalikan array berisi path file yang SEDANG DIPAKAI oleh data.
    protected array $references = [];

    public function __construct()
    {
        parent::__construct();

        // Setiap baris = satu folder storage → cara ambil daftar file yang dipakai:
        // (mengambil kolom path foto dari semua baris tabel terkait, file null dilewati nanti)
        $this->references = [
            'campaigns'          => fn() => Campaign::whereNotNull('image')->pluck('image')->toArray(),          // folder foto kampanye → kolom campaigns.image
            'foster_children'    => fn() => FosterChild::whereNotNull('photo')->pluck('photo')->toArray(),        // folder foto anak asuh → foster_children.photo
            'child-developments' => fn() => ChildDevelopment::whereNotNull('foto')->pluck('foto')->toArray(),     // folder foto laporan perkembangan → child_developments.foto
            'payment-proofs'     => fn() => Donation::whereNotNull('payment_proof')->pluck('payment_proof')      // bukti pembayaran ada DI 2 TABEL:
                ->merge(Sponsorship::whereNotNull('payment_proof')->pluck('payment_proof'))                       //   donations.payment_proof ∪ sponsorships.payment_proof (digabung merge)
                ->toArray(),
            'pendiri'            => fn() => Pendiri::whereNotNull('foto')->pluck('foto')->toArray(),             // folder foto pendiri → pendiris.foto
            'news'               => fn() => News::whereNotNull('foto_utama')->pluck('foto_utama')->toArray(),    // folder foto berita → news.foto_utama
            'avatars'            => fn() => User::whereNotNull('avatar')->pluck('avatar')->toArray(),            // folder avatar pengguna → users.avatar
            'logo'               => fn() => [ProfilYayasan::first()?->logo],                                     // profil yayasan single-row: cuma 1 file logo
            'legalitas'          => fn() => [ProfilYayasan::first()?->foto_legalitas],                            // foto legalitas (1 baris saja)
            'struktur'           => fn() => [ProfilYayasan::first()?->foto_struktur],                             // foto struktur organisasi (1 baris saja)
        ];
    }

    public function handle()
    {
        // ── FASE 1: HAPUS FOLDER LEGACY ─────────────────────────
        // Folder peninggalan sistem lama yang format penamaannya sudah tidak dipakai:
        //   'payment_proofs' (underscore) → sekarang pakai 'payment-proofs' (strip)
        //   'qris' → fitur QRIS dihapus dari sistem
        $legacyDirs = ['payment_proofs', 'qris'];
        foreach ($legacyDirs as $dir) {
            if (Storage::disk('public')->exists($dir)) {          // cek folder ada di storage
                $files = Storage::disk('public')->allFiles($dir); // ambil semua file di dalamnya
                if (!empty($files)) {
                    $this->line("Folder <comment>{$dir}/</comment>: {$this->countFiles($files)} file (legacy)");
                    if ($this->option('force')) {
                        Storage::disk('public')->deleteDirectory($dir);   // hapus seluruh folder beserta isinya
                        $this->info("  [OK] Folder {$dir}/ dihapus");
                    } else {
$this->warn("  [!] Akan dihapus (pakai --force)");
                    }
                }
            }
        }

        // ── FASE 2: CEK SETIAP FOLDER AKTIF ─────────────────────
        // Loop semua folder yang ada di daftar $references
        foreach ($this->references as $folder => $callback) {
            if (!Storage::disk('public')->exists($folder)) {      // folder tidak ada di disk → skip
                continue;
            }

            $filesOnDisk = Storage::disk('public')->allFiles($folder);   // daftar file yang BENAR-BENAR ada di disk
            if (empty($filesOnDisk)) {
                continue;                                         // folder kosong → tidak ada yang perlu dicek
            }

            $usedFiles = $callback();       // ambil daftar file yang DIPAKAI database (dari kolom path foto)
            $usedFiles = array_filter($usedFiles);                 // BUANG null — misal ProfilYayasan::first()?->logo bisa null (profil belum diisi)

            // INI LOGIKA INTI:
            // array_diff = file yang ada di disk (filesOnDisk) tapi TIDAK ada di daftar database (usedFiles)
            $orphaned = array_diff($filesOnDisk, $usedFiles);

            if (empty($orphaned)) {
                $this->line("Folder <comment>{$folder}/</comment>: {$this->countFiles($filesOnDisk)} file — semua terpakai");
                continue;
            }

            // Hitung total ukuran file sampah (untuk laporan)
            $totalSize = 0;
            foreach ($orphaned as $file) {
                $totalSize += Storage::disk('public')->size($file);
            }

            $this->line("Folder <comment>{$folder}/</comment>: {$this->countFiles($orphaned)} file sampah (~{$this->formatBytes($totalSize)})");

            // Mode FORCE → hapus sungguhan; mode preview → hanya tampilkan daftar file
            if ($this->option('force')) {
                foreach ($orphaned as $file) {
                    Storage::disk('public')->delete($file);        // hapus satu per satu file sampah
                }
                $this->info("  [OK] {$this->countFiles($orphaned)} file dihapus");
            } else {
                foreach ($orphaned as $file) {
                    $this->warn("  [!] {$file}");                  // preview: sebutkan file yang akan dihapus
                }
            }
        }

        // ── FASE 3: FILE STATIS TIDAK TERPAKAI ──────────────────
        // File hero-bg.jpg di public/images bukan hasil upload (disimpan langsung,
        // bukan via storage) sehingga tidak ada "referensi kolom" — ditangani manual.
        $heroBg = public_path('images/hero-bg.jpg');
        if (file_exists($heroBg)) {
            $size = filesize($heroBg);
            $this->line("File <comment>public/images/hero-bg.jpg</comment>: ~{$this->formatBytes($size)} (tidak dipakai)");
            if ($this->option('force')) {
                @unlink($heroBg);                                  // @ = sembunyikan warning kalau gagal hapus
                $this->info("  [OK] public/images/hero-bg.jpg dihapus");
            } else {
                $this->warn("  [!] Akan dihapus (pakai --force)");
            }
        }

        // ── PENUTUP ─────────────────────────────────────────────
        $this->newLine();
        $mode = $this->option('force') ? 'Penghapusan selesai' : 'Jalankan dengan --force untuk menghapus';
        $this->info($mode);
    }

    // Ambil jumlah file (hanya pembungkus count untuk kejelasan kode)
    private function countFiles(array $files): int
    {
        return count($files);
    }

    // Ubah byte → format mudah dibaca (B, KB, MB)
    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024)    return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }
}