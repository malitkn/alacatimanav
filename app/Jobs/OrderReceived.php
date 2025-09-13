<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\Models\NotificationUser;
use App\Jobs\NotifyUserByTelegram;

class OrderReceived implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
	
	public $users;
	
    public function __construct()
    {
        $this->users = NotificationUser::all()->pluck('chat_id')->toArray();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
		try {
			// Log::channel('orders')->info('aaa', ['usrs' => $this->users]);
		foreach ($this->users as $user) {
			NotifyUserByTelegram::dispatch($user);
			Log::channel('orders')->info('[OrderReceived] Bildirim kuyruğa eklendi.');
		}
		} catch (\Exception $e) {
			Log::channel('orders')->error('[OrderReceived] Bildirimler kuyruğa eklenemedi', ['message' => $e->getMessage()]);
		}
		

	
    }
}
