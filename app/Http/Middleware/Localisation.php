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
        if(session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
            app('VoyagerAuth')->user()->locale = session()->get('locale');
        }

        return $next($request);
    }
}
