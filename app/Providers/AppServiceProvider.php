<?php

namespace App\Providers;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Telegram\Bot;
use App\Yemeksepeti\Order;
use App\Getir\Product;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

	public $singletons = [
		Order::class => Order::class,
		Product::class => Product::class,
		
	];
	
    public function register(): void
    {
        $this->app->singleton(Bot::class, function ($app) {
        return new Bot();
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('pagination::default');
    }
}
