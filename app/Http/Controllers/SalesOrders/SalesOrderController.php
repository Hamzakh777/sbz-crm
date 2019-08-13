<?php

namespace App\Http\Controllers\SalesOrders;

use App\SalesOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesOrderController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesOrders = SalesOrder::paginate('10');
        return response()->json([
            'salesOrders' => $salesOrders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
