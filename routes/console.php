<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('sponsorships:check-due')->dailyAt('08:00');
Schedule::command('sponsorships:send-email-reminders')->dailyAt('08:30');