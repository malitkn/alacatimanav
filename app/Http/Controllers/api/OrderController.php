<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Yemeksepeti\Order;
use App\Telegram\Bot;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
	private $order;
	
    public function __construct(Order $order)
    {
        $this->orders = $order;
    }


    public function getOrders()
    {
       $orders = $this->orders->getLastOrders();
		
		return response()->json($orders);
    }
	
	/* public function hasOrder()
	{
			try {
			$lastOrders = array_slice($this->orders,0,3);
			$seenOrderIds = Cache::get('seenOrderIds', []);
				
			foreach ($lastOrders as $lastOrder) {
				if($lastOrder["orderStatus"] != "DELIVERED" && !in_array($lastOrder['orderId'], $seenOrderIds)) {
				Log::channel('orders')->info('Bildirim tetiklendi!', $lastOrder);
				$seenOrderIds[] = $lastOrder['orderId'];
				OrderReceived::dispatch();
				}
				Log::channel('orders')->info('Last Order:', $lastOrder); 
			}
				Cache::put('seenOrderIds', $seenOrderIds);
				   } catch (\Exception $e) {
				Log::channel('orders')->error('Sipariş kontrol hatası: ' . $e->getMessage());
		} 
		*/
	
	public function test(Bot $bot)
	{
		dd($bot->getUsers());
	}
	
}
