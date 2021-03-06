<?php

namespace App\Http\Controllers\SalesOrders;

use App\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\addSalesOrderPerson;
use App\Http\Requests\StoreSalesOrders;

class SalesOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreSalesOrders $request)
    {
        // $validate = $request->validated();

        $salesOrder = new SalesOrder();

        // contract info
        $salesOrder->current_insurance_id = $request->input('currentInsuranceId');
        $salesOrder->new_insurance_id = $request->input('newInsuranceId');
        $salesOrder->owner_full_name = $request->input('fullName');
        $salesOrder->owner_address = $request->input('address');
        $salesOrder->owner_household_type = $request->input('householdType');
        $salesOrder->number_of_family_members_in_the_same_household = $request->input('numberOfFamilyMembers');
        $salesOrder->new_born = $request->input('newBorn');
        $salesOrder->move_to_switzerland = $request->input('moveToSwitzerland');
        $salesOrder->sales_lead_source = $request->input('salesLeadSource');
        $salesOrder->sales_user_id = $request->input('salesPersonId');
        $salesOrder->sales_order_status = $request->input('salesOrderStatus');
        $salesOrder->insurance_status = $request->input('insuranceStatus');
        $salesOrder->contract_duration_VVG = $request->input('contractDurationVVG');
        $salesOrder->contract_duration_KVG = $request->input('contractDurationKVG');
        $salesOrder->insurance_tracking_id = $request->input('insuranceTrackingID');
        $salesOrder->created_by_id = auth()->user()->id;
        
        if($request->input('contractStartKVG')) {
            $salesOrder->contract_start_KVG = Carbon::parse($request->input('contractStartKVG'))->addHour()->format('Y-m-d');
        }
        if ($request->input('contractStartVVG')) {
            $salesOrder->contract_start_VVG = Carbon::parse($request->input('contractStartVVG'))->addHour()->format('Y-m-d');
        }
        if ($request->input('insuranceSubmittedDate')) {
            $salesOrder->insurance_submitted_date = Carbon::parse($request->input('insuranceSubmittedDate'))->addHour()->format('Y-m-d');
        }
        if ($request->input('signDate')) {
            $salesOrder->contract_sign_date = Carbon::parse($request->input('signDate'))->addHour()->format('Y-m-d');
        }

        // checkpoint details
        $salesOrder->cancellation_original = $request->input('cancellationOriginal');
        $salesOrder->cancellation_stamped = $request->input('cancellationStamped');
        $salesOrder->provision_done = $request->input('provisionDone');

        $salesOrder->save();

        return response()->json([
            'id' => $salesOrder->id
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
        // we have to check all the models that have a relationship with the sales order and send them back
        // with the response
        // also we need to add some fields like documentId and so on
        // fortunatly laravel provides a native way to eager load the modals related to this one
        $salesOrder = SalesOrder::with(['documents', 'people', 'comments', 'tasksCollections'])->findOrFail($id);

        $salesOrder->people->transform(function ($item, $key) { 
            return [
                'firstName' => $item->first_name,
                'lastName' => $item->last_name,
                'gender' => $item->gender,
                'birthday' => $item->birthday,
                'policeNumber' => $item->policeNumber,
                'salesOrderId' => $item->salesOrderId,
                'products' => $item->products,
                'id' => $item->id
            ];
        });

        $tasksCollections = $salesOrder->tasksCollections->toArray();
        if(count($tasksCollections) !== 0) {
            $salesOrder->taskCollectionId = $tasksCollections[0]['id'];
        }

        return response()->json([
            'salesOrder' => $salesOrder
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = SalesOrder::with(['documents', 'people', 'comments', 'tasksCollections'])->findOrFail($id);

        return response()->json([
            'order' => $order
        ]);
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
        // only the ids that in the intermediate table will remaine
        // $validate = $request->validated();

        $salesOrder = SalesOrder::with(['documents', 'people', 'comments', 'tasksCollections'])->findOrFail($id);

        // contract info
        $salesOrder->current_insurance_id = $request->input('currentInsuranceId');
        $salesOrder->new_insurance_id = $request->input('newInsuranceId');
        $salesOrder->owner_full_name = $request->input('fullName');
        $salesOrder->owner_address = $request->input('address');
        $salesOrder->owner_household_type = $request->input('householdType');
        $salesOrder->number_of_family_members_in_the_same_household = $request->input('numberOfFamilyMembers');
        $salesOrder->new_born = $request->input('newBorn');
        $salesOrder->move_to_switzerland = $request->input('moveToSwitzerland');
        $salesOrder->sales_lead_source = $request->input('salesLeadSource');
        $salesOrder->sales_user_id = $request->input('salesPersonId');
        $salesOrder->sales_order_status = $request->input('salesOrderStatus');
        $salesOrder->insurance_status = $request->input('insuranceStatus');
        $salesOrder->contract_duration_VVG = $request->input('contractDurationVVG');
        $salesOrder->contract_duration_KVG = $request->input('contractDurationKVG');
        $salesOrder->insurance_tracking_id = $request->input('insuranceTrackingID');

        // checkpoint details
        $salesOrder->cancellation_original = $request->input('cancellationOriginal');
        $salesOrder->cancellation_stamped = $request->input('cancellationStamped');
        $salesOrder->provision_done = $request->input('provisionDone');

        if ($request->input('contractStartKVG')) {
            $salesOrder->contract_start_KVG = Carbon::parse($request->input('contractStartKVG'))->addHour()->format('Y-m-d');
        }
        if ($request->input('contractStartVVG')) {
            $salesOrder->contract_start_VVG = Carbon::parse($request->input('contractStartVVG'))->addHour()->format('Y-m-d');
        }
        if ($request->input('insuranceSubmittedDate')) {
            $salesOrder->insurance_submitted_date = Carbon::parse($request->input('insuranceSubmittedDate'))->addHour()->format('Y-m-d');
        }
        if ($request->input('signDate')) {
            $salesOrder->contract_sign_date = Carbon::parse($request->input('signDate'))->addHour()->format('Y-m-d');
        }
        
        $salesOrder->save();

        return response()->json([
            'id' => $salesOrder->id
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
