<?php

/*
 * console.php — Scheduled Tasks (Cron)
 * =====================================
 * File ini mendefinisikan task yang jalan otomatis via scheduler Laravel.
 * Di server production, harus ada cron entry:
 *   * * * * * cd /path/project && php artisan schedule:run >> /dev/null 2>&1
 *
 * Task aktif:
 *   - sponsorships:check-due → JAM 08:00 setiap hari
 *     a) Kirim WA reminder ke donatur H-3 sebelum sponsorship expired
 *     b) Auto-expire sponsorship yg sudah lewat tanggal berakhir
 *
 *   - db:backup → JAM 02:00 setiap hari
 *     Backup database MySQL ke storage/app/backups/ (disimpan 30 hari)
 */

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Command bawaan Laravel (tidak penting, hanya untuk testing)
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ─── SCHEDULE UTAMA ──────────────────────────────────────
// Setiap hari jam 08:00 WIB, cek & kirim reminder sponsorship
Schedule::command('sponsorships:check-due')->dailyAt('08:00');

// Setiap hari jam 02:00 WIB, backup database (simpan 30 hari)
Schedule::command('db:backup')->dailyAt('02:00');