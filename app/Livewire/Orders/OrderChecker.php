<?php

namespace App\Livewire\Orders;

use App\Yemeksepeti\Order;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Component;


class OrderChecker extends Component
{
	
	
	public function mount()
	{
	}
    public function render()
    {
        return view('livewire.orders.order-checker');
    }
	
	public function check(\App\Yemeksepeti\Order $order)
	{
		// $this->dispatch('hasNewOrder');
		$lock = Cache::lock('order-checker-lock', 16); // 10 saniyelik kilit
		if ($lock->get()) {
			try {
			$lastOrder = $order->getLastOrders()[0];
			$seenOrderId = Cache::get('seenOrderId', 'empty');
			if($lastOrder["orderStatus"] != "DELIVERED" && $lastOrder['orderId'] != $seenOrderId) {
				$this->dispatch('hasNewOrder');
				Log::channel('orders')->info('Bildirim tetiklendi!', $lastOrder);
				Cache::put('seenOrderId', $lastOrder['orderId']);
			}
			Log::channel('orders')->info('Last Order:', $lastOrder);
		
			} catch (\Exception $e) {
			Log::channel('orders')->error('Sipariş kontrol hatası: ' . $e->getMessage());
		} finally {
            $lock->release();
        } // try son
	} else {
        // kilit alınamadı, başka istek çalışıyor
        Log::channel('orders')->info('İstek atlandı. (Cache Lock)');
    }
				
		// COURIER_NEAR_PICK_UP
		// PICKED_UP in_array($lastOrder['orderStatus'], ['SENDING_TO_VENDOR', 'COURIER_NEAR_PICK_UP', 'PICKED_UP']
				
	/*			
		if( $lastOrder["orderStatus"] != "DELIVERED" && $lastOrder['orderId'] !== $cacheOrderId) {
			$this->dispatch('hasNewOrder');
			Log::channel('orders')->info('Bildirim tetiklendi!', $lastOrder);
			Cache::put('lastOrderId', $lastOrder['orderId']);
		} // order kontrol son
				
	*/		
		
	}
	
}
