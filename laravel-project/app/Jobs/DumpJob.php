<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class DumpJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly string $name)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('JobName: ' . $this->name . ' is started.');
        sleep(30);
        Log::info('first step is done.');
        sleep(30);
        Log::info('second step is done.');
        sleep(30);
        Log::info('third step is done.');
        sleep(30);
        Log::info('JobName: ' . $this->name . ' is done.');
    }
}
