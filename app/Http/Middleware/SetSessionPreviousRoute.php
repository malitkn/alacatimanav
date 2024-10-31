<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class SetSessionPreviousRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->setRoute($request);
        return $next($request);
    }
    protected function setRoute($request): void
    {
        $routeName = Route::CurrentRouteName();
        $request->session()->put('route', $routeName);
    }
}
