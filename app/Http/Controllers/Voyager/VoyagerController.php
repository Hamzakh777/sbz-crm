<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;

class VoyagerController extends BaseVoyagerController
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
    
    public function index()
    {
        return Voyager::view('voyager::index');
    }
}
