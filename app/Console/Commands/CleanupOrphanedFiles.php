<?php

/*
 * CleanupOrphanedFiles — Hapus file sampah di storage
 * =====================================================
 * Command ini memindai semua folder storage/app/public/ dan menghapus file
 * yang TIDAK TERREFERENSI di database.
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
    protected $signature = 'storage:cleanup {--force : Benar-benar hapus file}';
    protected $description = 'Hapus file di storage yang tidak terpakai di database';

    // Mapping folder → callback untuk ambil daftar file yg dipakai di DB
    protected array $references = [];

    public function __construct()
    {
        parent::__construct();

        $this->references = [
            'campaigns'          => fn() => Campaign::whereNotNull('image')->pluck('image')->toArray(),
            'foster_children'    => fn() => FosterChild::whereNotNull('photo')->pluck('photo')->toArray(),
            'child-developments' => fn() => ChildDevelopment::whereNotNull('foto')->pluck('foto')->toArray(),
            'payment-proofs'     => fn() => Donation::whereNotNull('payment_proof')->pluck('payment_proof')
                ->merge(Sponsorship::whereNotNull('payment_proof')->pluck('payment_proof'))
                ->toArray(),
            'pendiri'            => fn() => Pendiri::whereNotNull('foto')->pluck('foto')->toArray(),
            'news'               => fn() => News::whereNotNull('foto_utama')->pluck('foto_utama')->toArray(),
            'avatars'            => fn() => User::whereNotNull('avatar')->pluck('avatar')->toArray(),
            'logo'               => fn() => [ProfilYayasan::first()?->logo],
            'legalitas'          => fn() => [ProfilYayasan::first()?->foto_legalitas],
            'struktur'           => fn() => [ProfilYayasan::first()?->foto_struktur],
        ];
    }

    public function handle()
    {
        // Hapus dulu folder payment_proofs (underscore) — sudah tidak dipakai
        $legacyDirs = ['payment_proofs', 'qris'];
        foreach ($legacyDirs as $dir) {
            if (Storage::disk('public')->exists($dir)) {
                $files = Storage::disk('public')->allFiles($dir);
                if (!empty($files)) {
                    $this->line("Folder <comment>{$dir}/</comment>: {$this->countFiles($files)} file (legacy)");
                    if ($this->option('force')) {
                        Storage::disk('public')->deleteDirectory($dir);
                        $this->info("  ✔ Folder {$dir}/ dihapus");
                    } else {
                        $this->warn("  ⚠ Akan dihapus (pakai --force)");
                    }
                }
            }
        }

        // Cek tiap folder
        foreach ($this->references as $folder => $callback) {
            if (!Storage::disk('public')->exists($folder)) {
                continue;
            }

            $filesOnDisk = Storage::disk('public')->allFiles($folder);
            if (empty($filesOnDisk)) {
                continue;
            }

            $usedFiles = $callback();
            $usedFiles = array_filter($usedFiles); // buang null

            $orphaned = array_diff($filesOnDisk, $usedFiles);

            if (empty($orphaned)) {
                $this->line("Folder <comment>{$folder}/</comment>: {$this->countFiles($filesOnDisk)} file — semua terpakai ✅");
                continue;
            }

            $totalSize = 0;
            foreach ($orphaned as $file) {
                $totalSize += Storage::disk('public')->size($file);
            }

            $this->line("Folder <comment>{$folder}/</comment>: {$this->countFiles($orphaned)} file sampah (~{$this->formatBytes($totalSize)})");

            if ($this->option('force')) {
                foreach ($orphaned as $file) {
                    Storage::disk('public')->delete($file);
                }
                $this->info("  ✔ {$this->countFiles($orphaned)} file dihapus");
            } else {
                foreach ($orphaned as $file) {
                    $this->warn("  ⚠ {$file}");
                }
            }
        }

        // Cek public/images/hero-bg.jpg
        $heroBg = public_path('images/hero-bg.jpg');
        if (file_exists($heroBg)) {
            $size = filesize($heroBg);
            $this->line("File <comment>public/images/hero-bg.jpg</comment>: ~{$this->formatBytes($size)} (tidak dipakai)");
            if ($this->option('force')) {
                @unlink($heroBg);
                $this->info("  ✔ public/images/hero-bg.jpg dihapus");
            } else {
                $this->warn("  ⚠ Akan dihapus (pakai --force)");
            }
        }

        $this->newLine();
        $mode = $this->option('force') ? 'Penghapusan selesai ✅' : 'Jalankan dengan --force untuk menghapus';
        $this->info($mode);
    }

    private function countFiles(array $files): int
    {
        return count($files);
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024)    return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }
}
