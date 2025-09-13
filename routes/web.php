<?php

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\MediaController;
use App\Http\Controllers\Back\SettingController;
use \App\Http\Controllers\Back\Product\UpdateController as ProductUpdateController;
use App\Livewire\Products\Setting;
use App\Livewire\Products\Status;
use \App\Http\Controllers\api\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Api;

Route::view('/', 'auth.login')->name('home');

Route::prefix('admin')->group(function () {
    Route::middleware('auth', 'SetPreviousRoute')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('/settings')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('settings.index');
            Route::put('/', [SettingController::class, 'update'])->name('settings.update');
            Route::patch('/', [MediaController::class, 'update'])->name('media.update');
        });
        Route::get('/products/update', [ProductUpdateController::class, 'index'])->name('products.update');
        Route::get('/products/settings', Setting::class)->name('products.settings');
		Route::get('/products/update/status', Status::class)->name('products.update.status');
    });
});

Route::post('/api/orders', [OrderController::class, 'getOrders'])->middleware(Api::class)->name('api.orders.post');
 Route::get('/api/getUsers', [OrderController::class, 'test']);

require __DIR__ . '/auth.php';
