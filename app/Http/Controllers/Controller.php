<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //
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

            // making the localisation files vailable for vue js
            view()->share('localisations', ExportLocalization::export()->toFlat());

            return $next($request);
        });
    }

}
