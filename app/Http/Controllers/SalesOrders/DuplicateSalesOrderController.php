<?php

namespace App\Http\Controllers\SalesOrders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;

class DuplicateSalesOrderController extends Controller
{
    public function index($id) {
        $salesOrder = SalesOrder::findOrFail($id);

        $newSalesOrder = $salesOrder->duplicate();

        sleep(4);
        // duplicating people causes of problem of adding products that weren't assigned originally
        // we might need to do that manually
        return response()->json([
            'id' => $newSalesOrder->id
        ]);
    } 
}
