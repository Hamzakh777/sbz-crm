<?php

namespace App\Http\Controllers\SalesOrders;

use App\SalesOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksCollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($salesOrderId)
    {
        $salesOrders = SalesOrder::findOrFail($salesOrderId);

        $collec = $salesOrders->tasksCollections->first();

        if(isset($collec)) {
            $tasksCollectionId = $collec->id;
        } else {
            $tasksCollectionId = null;
        }

        return response()->json([
            'tasksCollectionId' => $tasksCollectionId
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
    public function update(Request $request, $salesOrderId, $tasksCollecId = null)
    {   
        $salesOrder = SalesOrder::findOrFail($salesOrderId);

        if (isset($tasksCollecId)) {
            $salesOrder->tasksCollections()->sync([$tasksCollecId]);
        } else {
            $salesOrder->tasksCollections()->sync([]);
        }

        return response()->json([
            'saleOrderTasksColl' => $salesOrder->tasksCollections()
        ]);
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
