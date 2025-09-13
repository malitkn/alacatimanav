<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class CleanLogs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
		try {
        File::put(storage_path('logs/orders.log'), '');
		Log::channel('orders')->info('Orders.log silindi.');
		Artisan::call('queue:restart');
		Artisan::call('queue:flush');
		} catch (\Exception $e) {
			Log::critical('Kritik hata', ['error' => $e->getMessage()]);
		}
    }
}
