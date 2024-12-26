<?php

use App\Jobs\DumpJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;
use Ramsey\Uuid\Uuid;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call(function () {
    $uuid = Uuid::uuid4();
    Log::info('JobName: ' . $uuid . ' is dispatched.');
    DumpJob::dispatch(date('Y-m-d H:i:s') . ' ' . $uuid);
})->everyMinute();
