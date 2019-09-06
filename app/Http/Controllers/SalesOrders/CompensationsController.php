<?php

namespace App\Http\Controllers\SalesOrders;

use App\SalesOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompensationsController extends Controller
{
    public function index($salesOrderId) {
        
        $salesOrder = SalesOrder::findOrFail($salesOrderId);
        
        $compensation = $salesOrder->compensation;

        if($compensation !== null) {
            $compensation->sales_order_people = $salesOrder->people; 
            return response()->json([
                'compensation' => $compensation
            ]);
        } else {
            return response()->json([
                'compensation' => null
            ]);
        }
    }
}
