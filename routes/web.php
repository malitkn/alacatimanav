<?php

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\MediaController;
use App\Http\Controllers\Back\SettingController;
use \App\Http\Controllers\Back\Product\UpdateController as ProductUpdateController;
use \App\Http\Controllers\Back\Product\SettingController as ProductSettingController;
use Illuminate\Support\Facades\Route;

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
        Route::get('/products/settings', [ProductSettingController::class, 'index'])->name('products.settings');
    });
});

require __DIR__ . '/auth.php';
