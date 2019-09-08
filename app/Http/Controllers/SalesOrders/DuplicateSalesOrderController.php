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

        $newSalesOrderId = $newSalesOrder->id;
        // duplicating people using the duplication package -- check the sales order model -- 
        //causes of problem of adding products that weren't assigned originally
        // we might need to do that manually
        $people = $salesOrder->people;
        foreach ($people as $key => $person) {
            $copy = $person->replicate();
            $copy->sales_order_id = $newSalesOrderId;
            $copy->push();

            // then we add the products
            $products = $person->products;
            if(count($products) !== 0) {
                $productsIds = [];
                foreach ($products as $key => $product) {
                    array_push($productsIds, $product->id);
                }
                $copy->products()->attach($productsIds);
            }
        }
        return response()->json([
            'id' => $newSalesOrder->id
        ]);
    } 
}
