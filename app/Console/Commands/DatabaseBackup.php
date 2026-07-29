<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DatabaseBackup extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Backup database MySQL ke file .sql.gz';

    public function handle(): int
    {
        $filename = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
        $backupDir = storage_path('app/backups');

        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $path = $backupDir . '/' . $filename;

        $db = config('database.connections.mysql');
        $mysqldump = $this->findMysqldump();

        $nullDevice = PHP_OS_FAMILY === 'Windows' ? 'NUL' : '/dev/null';

        $command = sprintf(
            '"%s" --user=%s --password=%s --host=%s --port=%s --single-transaction --no-tablespaces --skip-lock-tables --routines %s > "%s" 2>%s',
            $mysqldump,
            $db['username'],
            $db['password'],
            $db['host'],
            $db['port'],
            $db['database'],
            $path,
            $nullDevice
        );

        $output = [];
        $resultCode = 0;
        exec($command, $output, $resultCode);

        if (!file_exists($path) || filesize($path) === 0) {
            $this->error('Backup gagal — file tidak dibuat atau kosong.');
            if ($resultCode !== 0) {
                $this->error("mysqldump exit code: {$resultCode}");
            }
            return Command::FAILURE;
        }

        $gzPath = $path . '.gz';
        $gz = gzopen($gzPath, 'w9');
        gzwrite($gz, file_get_contents($path));
        gzclose($gz);
        unlink($path);

        $size = $this->formatSize(filesize($gzPath));
        $this->info("Backup berhasil: {$filename}.gz ({$size})");

        $this->cleanOldBackups($backupDir, 30);

        return Command::SUCCESS;
    }

    private function findMysqldump(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $paths = [
                'C:\\laragon\\bin\\mysql\\mysql-8.0.30-winx64\\bin\\mysqldump.exe',
                'C:\\laragon\\bin\\mysql\\mysql-8.1.0-winx64\\bin\\mysqldump.exe',
                'C:\\xampp\\mysql\\bin\\mysqldump.exe',
                'mysqldump',
            ];
            foreach ($paths as $path) {
                if (file_exists($path)) return $path;
            }
            return 'mysqldump';
        }

        return 'mysqldump';
    }

    private function cleanOldBackups(string $dir, int $days): void
    {
        $files = glob($dir . '/*.sql.gz');
        if (!$files) return;

        $cutoff = now()->subDays($days)->timestamp;
        $deleted = 0;

        foreach ($files as $file) {
            if (filemtime($file) < $cutoff) {
                unlink($file);
                $deleted++;
            }
        }

        if ($deleted > 0) {
            $this->info("Backup lama dihapus: {$deleted} file");
        }
    }

    private function formatSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
