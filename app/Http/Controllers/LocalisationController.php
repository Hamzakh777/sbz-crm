<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalisationController extends Controller
{
    /**
     * Switch the local
     * 
     */
    public function index($lang) {
        
        app()->setLocale($lang);
        app('VoyagerAuth')->user()->locale = $lang;

        session()->put('locale', $lang);
        return redirect()->back();
    }
}
