<?php

// routes/console.php — Artisan Console Routes
// Tempat mendefinisikan closure-based Artisan commands.

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
