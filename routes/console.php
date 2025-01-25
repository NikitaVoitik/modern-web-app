<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule the backup command
Artisan::command('schedule:backup', function () {
    $schedule = app(Schedule::class);
    $schedule->command('backup:run')->daily()->at('02:00');
})->purpose('Schedule daily backups');
