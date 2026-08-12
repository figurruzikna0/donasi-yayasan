<?php

/*
 * DatabaseBackup — Backup database MySQL ke file .sql.gz
 * =======================================================
 * Tujuan: menyalin SELURUH database menjadi file SQL lalu dikompres GZIP,
 * disimpan di storage/app/backups/ dan otomatis dibersihkan setelah 30 hari.
 *
 * Cara pakai:
 *   php artisan db:backup            → backup sekarang (file .sql.gz)
 *   php artisan db:backup            → dijadwalkan tiap hari 02:00 (routes/console.php)
 *
 * Teknologi:
 *   - Menggunakan binary 'mysqldump' dari MySQL/Laragon (bukan query PHP manual)
 *   - Hasilnya dikompres dengan gzip level 9 (ukuran paling kecil)
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DatabaseBackup extends Command
{
    protected $signature = 'db:backup';                                    // Nama perintah untuk menjalankan command ini
    protected $description = 'Backup database MySQL ke file .sql.gz';      // Penjelasan singkat command

    public function handle(): int
    {
        // 1) Buat nama file UNIK dengan timestamp: backup-2026-08-12_02-00-01.sql
        $filename = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
        $backupDir = storage_path('app/backups');                           // Tujuan simpan: storage/app/backups/

        // 2) Kalau folder backups belum ada → buat otomatis (0755 = bisa dibaca/tulis pemilik, baca eksekusi orang lain)
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);                                  // true = buat folder induknya sekalian (recursive)
        }

        $path = $backupDir . '/' . $filename;                               // Path lengkap file backup

        // 3) Ambil kredensial koneksi database dari config (database.php → .env)
        $db = config('database.connections.mysql');    // berisi host, port, database, username, password
        $mysqldump = $this->findMysqldump();           // cari path binary mysqldump (lihat fungsi di bawah)

        // 4) Redireksi output-error khusus Windows vs Linux:
        //    - Windows → 'NUL' (perangkat "lubang hitam" output)
        //    - Linux → '/dev/null'
        $nullDevice = PHP_OS_FAMILY === 'Windows' ? 'NUL' : '/dev/null';

        // 5) Bangun perintah shell mysqldump (string format):
        //    mysqldump --user=root --password=xxx --host=127.0.0.1 --port=3306
        //              --single-transaction --no-tablespaces --skip-lock-tables --routines
        //              nama_db > "path/file.sql" 2>NUL
        $command = sprintf(
            '"%s" --user=%s --password=%s --host=%s --port=%s --single-transaction --no-tablespaces --skip-lock-tables --routines %s > "%s" 2>%s',
            $mysqldump,                        // path binary mysqldump
            $db['username'],                   // username DB
            $db['password'],                   // password DB
            $db['host'],                       // host DB
            $db['port'],                       // port DB
            $db['database'],                   // nama database
            $path,                             // file tujuan (> = redirect stdout)
            $nullDevice                        // buang stderr (2>) — error tak mengotori layar
        );

        // Flag penting mysqldump:
        //   --single-transaction   → backup konsisten tanpa mengunci tabel → tidak mengganggu pengguna aktif
        //   --no-tablespaces       → hindari error di shared hosting (butuh izin khusus)
        //   --skip-lock-tables     → tidak pakai LOCK TABLE (aman di hosting bersama)
        //   --routines             → ikutkan stored procedure/function kalau ada

        // 6) EKSEKUSI perintah shell. exec() menjalankan perintah sistem operasi dari PHP.
        //    $output = baris-baris stdout; $resultCode = kode keluar (0 = sukses).
        $output = [];
        $resultCode = 0;
        exec($command, $output, $resultCode);

        // 7) VALIDASI: backup dianggap gagal kalau file tidak ada ATAU isinya 0 byte
        //    (misal: mysqldump tidak ditemukan, atau kredensial salah)
        if (!file_exists($path) || filesize($path) === 0) {
            $this->error('Backup gagal — file tidak dibuat atau kosong.');
            if ($resultCode !== 0) {
                $this->error("mysqldump exit code: {$resultCode}");   // tampilkan kode error dari OS
            }
            return Command::FAILURE;              // tandai command gagal (penting untuk monitoring cron)
        }

        // 8) KOMPRESI GZIP:
        //    gzopen(path, 'w9') → buka file gzip mode tulis level 9 (kompresi MUKSIMAL, file terkecil)
        //    gzwrite → tulis isi .sql ke dalam .gz
        //    gzclose → tutup; lalu unlink() menghapus file .sql yang sudah dikompres
        $gzPath = $path . '.gz';
        $gz = gzopen($gzPath, 'w9');
        gzwrite($gz, file_get_contents($path));
        gzclose($gz);
        unlink($path);

        // 9) Tampilkan hasil + ukuran file yang sudah dikompres (lewat formatSize, ubah byte → KB/MB/GB)
        $size = $this->formatSize(filesize($gzPath));
        $this->info("Backup berhasil: {$filename}.gz ({$size})");

        // 10) Bersihkan backup yang berumur > 30 hari (lihat fungsi di bawah)
        $this->cleanOldBackups($backupDir, 30);

        return Command::SUCCESS;                  // tandai command sukses
    }

    // ── CARI BINARY MYSQLDUMP ─────────────────────────────
    // Di Windows, mysqldump tidak otomatis ada di PATH — dicek satu per satu
    // dari lokasi umum Laragon/XAMPP. Di Linux cukup 'mysqldump' (sudah di PATH).
    private function findMysqldump(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $paths = [
                'C:\\laragon\\bin\\mysql\\mysql-8.0.30-winx64\\bin\\mysqldump.exe',
                'C:\\laragon\\bin\\mysql\\mysql-8.1.0-winx64\\bin\\mysqldump.exe',
                'C:\\xampp\\mysql\\bin\\mysqldump.exe',
                'mysqldump',                       // fallback: semoga sudah di PATH
            ];
            foreach ($paths as $path) {
                if (file_exists($path)) return $path;   // kembalikan path pertama yang ADA di disk
            }
            return 'mysqldump';                    // kalau tidak ada sama sekali → biarkan OS yang mencari
        }

        return 'mysqldump';                        // Linux: cukup nama binary
    }

    // ── BERSIHKAN BACKUP LAMA ─────────────────────────────
    // $days = umur maksimal penyimpanan (default 30 hari).
    // glob('*.sql.gz') = ambil semua file backup .sql.gz di folder.
    private function cleanOldBackups(string $dir, int $days): void
    {
        $files = glob($dir . '/*.sql.gz');
        if (!$files) return;                       // tidak ada file backup → selesai

        $cutoff = now()->subDays($days)->timestamp;    // batas waktu: 30 hari ke belakang (dalam detik epoch)
        $deleted = 0;

        foreach ($files as $file) {
            // filemtime() = waktu terakhir file dimodifikasi (detik)
            // kalau lebih TUA dari batas → hapus
            if (filemtime($file) < $cutoff) {
                unlink($file);                     // hapus file
                $deleted++;
            }
        }

        if ($deleted > 0) {
            $this->info("Backup lama dihapus: {$deleted} file");
        }
    }

    // ── FORMAT UKURAN FILE ────────────────────────────────
    // Ubah bilangan byte menjadi teks yang mudah dibaca: B, KB, MB, GB.
    private function formatSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {   // selama masih ≥1KB, naikkan satuan
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];          // contoh: 1.5 MB
    }
}