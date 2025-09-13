<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\Getir\Product;
use Carbon\Carbon;

class OpenGetirVendor implements ShouldQueue
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
    public function handle(Product $product): void
    {
       try {
		   $openingTime = Carbon::createFromFormat('H:i', config('credentials.vendor.openingTime'));
		   $before = $openingTime->copy()->subMinutes(15);
		   $after  = $openingTime->copy()->addMinutes(15);
		   $now = Carbon::now();
		   if ($now->equalTo($openingTime) || $now->between($before, $after)) {
			   $result = $product->openVendor();
		   }
		   if ($result) {
		   Log::channel('orders')->info('[OpenGetirVendorJob] Getir Açıldı.');
		   } else {
		   Log::channel('orders')->info('[OpenGetirVendorJob] Result false geldi.', ['message' => $result]);
		   }
	   } catch(\Exception $e) {
		   Log::channel('orders')->critical('[OpenGetirVendorJob] Getir Açılamadı.', ['message' => $e->getMessage()]);
	   }
		   
    }
}
