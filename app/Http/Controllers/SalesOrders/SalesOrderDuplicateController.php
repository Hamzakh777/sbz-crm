<?php

namespace App\Http\Controllers\SalesOrders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;
use Illuminate\Support\Facades\Storage;

class SalesOrderDuplicateController extends Controller
{
    public function index($id) {
        $salesOrder = SalesOrder::findOrFail($id);

        $newSalesOrder = $salesOrder->duplicate();

        $newSalesOrderId = $newSalesOrder->id;

        // duplicating people using the duplication package -- check the sales order model -- 
        // causes a problem of adding products that weren't assigned originally
        // we need to do that manually
        $people = $salesOrder->people;
        foreach ($people as $key => $person) {
            $copy = $person->replicate();
            $copy->sales_order_id = $newSalesOrderId;
            // duplicate the file attachement
            if (isset($person->document_id_path)) { 
                $path = $person->document_id_path;
                $fileExists = Storage::disk('spaces')->exists($path);
                if($fileExists) {
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $filename = pathinfo($path, PATHINFO_FILENAME);
                    $newPath = 'documents/id-cards/duplications/' . $filename . '.' . $ext;
                    Storage::copy($path, $newPath);

                    $copy->document_id_path = $newPath;
                } else {
                    $copy->document_id_path = null;
                }
            }
            $copy->push();

            // then we add the products
            $products = $person->products;
            if(count($products->toArray()) !== 0) {
                $productsIds = [];
                foreach ($products as $key => $product) {
                    array_push($productsIds, $product->id);
                }
                $copy->products()->attach($productsIds);
            }
        }

        // duplicate the associtaed documents
        $documents = $salesOrder->documents;
        foreach ($documents as $key => $document) {
            $copy = $document->replicate();
            $copy->sales_order_id = $newSalesOrderId;
            $documentPath = $document->path;
            if(isset($documentPath)) {
                $fileExists = Storage::disk('spaces')->exists($documentPath);
                if($fileExists) {
                    $ext = pathinfo($documentPath, PATHINFO_EXTENSION);
                    $filename = pathinfo($documentPath, PATHINFO_FILENAME);
                    $newPath = 'documents/duplications/' . $filename . '.' . $ext;
                    Storage::copy($documentPath, $newPath);

                    $copy->path = $newPath;
                } else {
                    $copy->path = null;
                }
            }
            $copy->push();
        }
        return response()->json([
            'id' => $newSalesOrder->id
        ]);
    } 
}
