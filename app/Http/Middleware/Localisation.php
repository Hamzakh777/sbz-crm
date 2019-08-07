<?php

namespace App\Http\Middleware;

use Closure;

class Localisation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session('locale')) {
            app()->setLocale(session('locale'));
            dd(session('locale'));
        }
        
        // dd(session('locale'));
        return $next($request);
    }
}
