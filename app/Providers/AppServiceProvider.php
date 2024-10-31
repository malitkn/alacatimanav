<?php

namespace App\Providers;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Breadcrumbs::macro('pageTitle', function ($route) {
            return ($breadcrumb = Breadcrumbs::generate($route)[0]) ? "{$breadcrumb->title} – " : '';
        });
    }
}
