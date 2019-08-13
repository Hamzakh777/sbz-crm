<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerUserController as BaseVoyagerUserController;

class VoyagerUserController extends BaseVoyagerUserController
{
    public function __construct()
    {

        // for some reasn when we change the locale
        // it reverts back to its previous state 
        // se localisation controller and middleware
        // I digured adding this bit of code solves the 
        // problem, a bit dirty but it works
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            if (session()->has('locale')) {
                app()->setLocale(session()->get('locale'));
            }

            return $next($request);
        });
    }
}
