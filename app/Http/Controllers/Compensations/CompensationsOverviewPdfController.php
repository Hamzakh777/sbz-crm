<?php

namespace App\Http\Controllers\Compensations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompensationPdf;
use App\Insurance;
use App\SalesOrder;
use App\User;
use Illuminate\Support\Arr;
use PDF;

class CompensationsOverviewPdfController extends Controller
{
    public function index(CreateCompensationPdf $request) {

        $periodPlanYear = (int)$request->query('periodPlanYear');
        $periodPlanMonth = (int)$request->query('periodPlanMonth');
        $payoutDate = str_replace('-', '/', $request->query('payoutDate'));
        $companyName = $request->input('companyName');
        $stAndNum = $request->input('stAndNum'); // street and number  
        $zipcode = $request->input('zipcode');
        $city = $request->input('city');
        $country = $request->input('country');

        $creator = auth()->user();
        $salesAgent = User::where('id', $request->query('salesAgentId'))->first();
        
        // sales compensations details
        // each sales order has a compensation associated with it
        $salesOrders = SalesOrder::with('compensation')->where('sales_user_id', $salesAgent->id)->get();
        
        // get only the sales orders that have a compensation
        // and the compensations that respect the selected period plan
        $salesOrders = $salesOrders->filter(function ($value, $key) use($periodPlanYear, $periodPlanMonth) {
            if($value->compensation !== null) {
                if($value->compensation->sales_compensations_period_plan_year === $periodPlanYear && $value->compensation->sales_compensations_period_plan_month === $periodPlanMonth) {
                    return true;
                }
            }
        });

        // if sales compensation is null we calculate it using 
        // the default compensation for each product
        $insuranceIds = $salesOrders->pluck('new_insurance_id')->toArray();
        $insurances = Insurance::whereIn('id', $insuranceIds)->get()->toArray();

        $salesOrders->transform(function ($item, $key) use($insurances){
            // each sales order has a new insurance associated with it
            foreach ($insurances as $key => $insurance) {
                if ((int) $item->new_insurance_id === (int) $insurance['id']) {
                    $item->new_insurance_name = $insurance['name'];
                }
            }

            if($item->compensation->sales_compensations_total === 0) {
                $sum = 0;
                // don't do anything if there are no contract people
                if((count($item->people) === 0)) {
                    return $item;
                }

                $item->people->map(function ($item, $key) use (&$sum) {
                    // if there is not products added don't do anything either
                    if(count($item->products) !== 0) {
                        $item->products->map(function ($item, $key) use (&$sum) {
                            return $sum = $item->compensation + $sum;
                        });
                    }
                });
                
                $item->compensation->sales_compensations_total = $sum;
                return $item;
            } else {
                return $item;
            }
        });

        // generate the pdf
        $pdf = PDF::loadview(
            'vendor.voyager.compensations.compensations_overview_pdf',
            [
                'salesAgent' => $salesAgent,
                'salesOrders' => $salesOrders,
                'creator' => $creator,
                'periodPlanYear' => $periodPlanYear,
                'periodPlanMonth' => $periodPlanMonth,
                'payoutDate' => $payoutDate,
                'companyName' => $companyName,
                'stAndNum' => $stAndNum,
                'zipcode' => $zipcode,
                'city' => $city,
                'country' => $country
            ]
        )
            ->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
