<?php

namespace App\Http\Controllers\SalesOrders;

use App\ContractPerson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\addSalesOrderPerson;
use App\SalesOrder;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ContractPerson as ContractPersonResource;

class SalesOrderPeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($salesOrderId)
    {
        $salesOrder = SalesOrder::findOrFail($salesOrderId);

        $people = $salesOrder->people;

        return response()->json([
            'people' => ContractPersonResource::collection($people)
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
    public function store(addSalesOrderPerson $request)
    {
        if($request->hasFile('documentIdCard')) {
            $path = $request->file('documentIdCard')->store('documents/id-cards');
        } else {
            $path = null;
        }
        
        $person = new ContractPerson();

        $person->first_name = $request->input('firstName');
        $person->last_name = $request->input('lastName');
        $person->gender = $request->input('gender');
        $person->police_number = $request->input('policeNumber');
        $person->birthday = Carbon::createFromFormat('D M d Y H:i:s e+',$request->input('birthday'))->addHour()->format('Y-m-d');
        $person->sales_order_id = $request->input('salesOrderId');
        $person->document_id_path = $path;
        $products = json_decode($request->input('products'));
        

        $person->save();

        // we have to attach the products 
        // after the person is saved since we 
        // will needs its id
        if (isset($products) && count($products) !== 0) {
            $productsIds = [];
            foreach ($products as $key => $product) {
                $product = (array)$product;
                array_push($productsIds, $product['id']);
            }
            $person->products()->attach($productsIds);
        }

        dd($person->products->toArray());
        // then we need to save the product with the person

        return response()->json([
            'person' => new ContractPersonResource($person),
        ]);
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
        $person = ContractPerson::findOrFail($id);

        if($person->document_id_path !== null) {
            Storage::delete($person->document_id_path);
        }

        $person->delete();
    }
}
