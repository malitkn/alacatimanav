<?php

namespace App\Telegram;



use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\NotificationUser;
// use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Bot
{
	private $token;
	
    public function __construct()
    {
        $this->token = config('credentials.telegram.bot.token', '8207067710:AAEqnIxHrQ8J3G_SkA2a-7mN5vPg8QUu02c');
		$this->notificationUsers = NotificationUser::all()->pluck('chat_id')->toArray();
		$this->limit = config('credentials.telegram.bot.getUsers.limit', 5);
    }
	
	public function sendNotification($user, $count = 2, $message = "🚨 Yeni Sipariş Geldi!"): void
	{
	
		// $message = "🚨 Yeni Sipariş Geldi!";
		try {
			for($i = 0; $i < $count; $i++) {
  	 				Http::post("https://api.telegram.org/bot$this->token/sendMessage", [
    				    'chat_id' => $user,
    			 	   'text'    => $message
    				]);
				sleep(4);
			}
		} catch (\Exception $e) {
			Log::channel('orders')->error('[Telegram Bot]' , ['message' => $e->getMessage()]);
		}

	}
	
	public function getUsers()
	{
		try {
		$response = Http::get("https://api.telegram.org/bot$this->token/getUpdates?limit=$this->limit");
		$users = data_get($response, 'result');
		 
		foreach ($users as $user) {
				$userId = $user['message']['chat']['id'];
				if (!in_array($userId, $this->notificationUsers)) {
					NotificationUser::create(['chat_id' => $userId]);
					$this->notificationUsers[] = $userId;
				}
			}
		$this->notificationUsers = NotificationUser::all()->pluck('chat_id')->toArray();
		} catch (\Exception $e) {
			Log::channel('orders')->error('[Telegram Bot]' , ['error' => $e->getMessage()]);
		}
	}

}
