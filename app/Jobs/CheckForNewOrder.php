<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\OrderReceived;
use App\Yemeksepeti\Order;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class CheckForNewOrder implements ShouldQueue
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
    public function handle(Order $order): void
    {
		  // OrderReceived::dispatch(); // NOT: queue:restart atman lazım her değişiklikte
		try {
			$openingTime = Carbon::createFromFormat('H:i', config('credentials.vendor.openingTime'));
			$closingTime = Carbon::createFromFormat('H:i', config('credentials.vendor.closingTime'));
			$now = Carbon::now();
			if (!$now->between($openingTime, $closingTime)) {
				Log::channel('orders')->warning('[CheckForNewOrderJob] Çalışması engellendi.');
				return;
			}
		    $orders = $order->getLastOrders();
			$lastOrders = array_slice($orders,0,3);
			$seenOrderIds = Cache::get('seenOrderIds', []);
				
			foreach ($lastOrders as $lastOrder) {
				if($lastOrder["orderStatus"] != "DELIVERED" && !in_array($lastOrder['orderId'], $seenOrderIds)) {
				 Log::channel('orders')->info('[CheckForNewOrderJob::Class] Bildirim tetiklendi!', $lastOrder);
				$seenOrderIds[] = $lastOrder['orderId'];
				OrderReceived::dispatch();
				}
			}
		$logInfo = collect($lastOrders)->map(fn($o) => Arr::only($o, ['orderId', 'orderStatus']))->toArray();
		Log::channel('orders')->info('[CheckForNewOrderJob::Class] Last Order:', $logInfo); 
		Cache::put('seenOrderIds', $seenOrderIds);
		} catch (\Exception $e) {
			Log::channel('orders')->critical('[CheckForNewOrderJob::Class] Kritik Hata:', [
				'message' => $e->getMessage(),
				'orders' => $lastOrders ?? null,
				'seenOrderIds' => $seenOrderIds ?? null,
			]);
		}
    }
}
