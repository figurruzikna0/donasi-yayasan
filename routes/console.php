<?php
// === console.php: routes Artisan dan scheduled tasks ===

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// --- KOMANDO: inspire → menampilkan kutipan inspiratif ---
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// --- SCHEDULE: sponsorships:check-due → jalankan setiap hari jam 08:00 ---
Schedule::command('sponsorships:check-due')->dailyAt('08:00');