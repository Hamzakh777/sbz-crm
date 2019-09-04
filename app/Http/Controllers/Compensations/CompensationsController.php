<?php

namespace App\Http\Controllers\compensations;

use App\Compensation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompensations;
use App\SalesOrder;

class CompensationsController extends Controller
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
    public function store(StoreCompensations $request)
    {
        $compensation = new Compensation();

        $compensation->insurance_id = $request->input('insuranceId');
        $compensation->insurance_provision_period_plan_month = $request->input('insuranceProvisionPeriodPlanMonth');
        $compensation->insurance_provision_period_plan_year = $request->input('insuranceProvisionPeriodPlanYear');
        $compensation->insurance_provision_period_plan_completed = $request->input('insuranceProvisionPeriodPlanCompleted');
        $compensation->total_provision_paid = $request->input('totalProvisionPaid');
        $compensation->provision_feedback = $request->input('provisionFeedback');
        $compensation->sales_compensations_payout_rate = $request->input('payoutRate');
        $compensation->sales_compensation_feedback = $request->input('salesCompensationFeedback');
        $compensation->insurance_id = $request->input('insuranceId');
        $compensation->sales_compensations_period_plan_month = $request->input('salesCompensationPeriodPlanMonth');
        $compensation->sales_compensations_period_plan_year = $request->input('salesCompensationPeriodPlanYear');
        $compensation->sales_compensations_period_plan_completed = $request->input('salesCompensationPeriodPlanCompleted');
        $compensation->sales_compensations_total = $request->input('totalSalesCompensation');
        $compensation->sales_order_id = $request->input('salesOrder.id');

        $compensation->save();

        return response()->json([
            'compensation' => $compensation
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
        $compensation = Compensation::findOrFail($id);

        $salesOrder = SalesOrder::findOrFail($compensation->sales_order_id);

        $compensation->sales_order_people = $salesOrder->people; 

        return response()->json([
            'compensation' => $compensation,
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
        $compensation = Compensation::findOrFail($id);
        
        $compensation->insurance_id = $request->input('insuranceId');
        $compensation->insurance_provision_period_plan_month = $request->input('insuranceProvisionPeriodPlanMonth');
        $compensation->insurance_provision_period_plan_year = $request->input('insuranceProvisionPeriodPlanYear');
        $compensation->insurance_provision_period_plan_completed = $request->input('insuranceProvisionPeriodPlanCompleted');
        $compensation->total_provision_paid = $request->input('totalProvisionPaid');
        $compensation->provision_feedback = $request->input('provisionFeedback');
        $compensation->sales_compensations_payout_rate = $request->input('payoutRate');
        $compensation->sales_compensation_feedback = $request->input('salesCompensationFeedback');
        $compensation->insurance_id = $request->input('insuranceId');
        $compensation->sales_compensations_period_plan_month = $request->input('salesCompensationPeriodPlanMonth');
        $compensation->sales_compensations_period_plan_year = $request->input('salesCompensationPeriodPlanYear');
        $compensation->sales_compensations_period_plan_completed = $request->input('salesCompensationPeriodPlanCompleted');
        $compensation->sales_compensations_total = $request->input('totalSalesCompensation');
        $compensation->sales_order_id = $request->input('salesOrder.id');

        $compensation->save();

        return response()->json([
            'compensation' => $compensation
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
