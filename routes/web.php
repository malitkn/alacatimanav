<?php

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\MediaController;
use App\Http\Controllers\Back\PageCategoryController;
use App\Http\Controllers\Back\SettingController;
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
        // Route::resource('pages',); TODO pages route
        Route::resource('pages/categories', PageCategoryController::class)->except(['edit', 'show'])->names([
            'index' => 'pages.categories.index',
            'store' => 'pages.categories.store',
            'create' => 'pages.categories.create',
            'update' => 'pages.categories.update',
            'destroy' => 'pages.categories.destroy',
        ]);
        Route::patch('pages/categories/slug/{category}', [PageCategoryController::class, 'isSlugUnique'])->name('slug.check');
    });
});

require __DIR__ . '/auth.php';
