<?php

namespace App\Http\Controllers\Reports\Insurance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Insurance;

class ReportsInsuranceController extends Controller
{
    /**
     * For each Insurance we group the salesorders by 
     * status and by timeframe
     */
    public function index() {
        $currentYear = (int) now()->year;
        $currentMonth = (int) now()->month;
        $quarterStartMonth = now()->firstOfQuarter()->month;
        $quarterEndMonth = now()->lastOfQuarter()->month;
        $halfYearStartMonth = now()->month >= 7 ? 7 : 1;
        $halfYearEndMonth = now()->month >= 7 ? 12 : 6;

        // maybe we should only be loading the insurances set as an active partner
        $insurances = Insurance::select(['name', 'id'])
            ->with(['salesOrders' => function($query) use ($currentYear){
                return $query
                    ->select(['id', 'new_insurance_id', 'sales_order_status', 'contract_sign_date'])
                    ->whereYear('contract_sign_date', $currentYear);
            }])
            ->withCount(['salesOrders as salesOrders_count' => function($query) use ($currentYear) {
                return $query->whereYear('contract_sign_date', $currentYear);
            }])
            ->orderByRaw('salesOrders_count desc')
            ->paginate(8);

        // group the sales orders by timeframe and status (open or closed)
        // for each insurance
        $salesOrderByTimeframeForEachInsurance = [];

        foreach ($insurances as $key => $item) {
            // each item is an insurance
            $insurance = [];
            $insurance['name'] = $item->name;

            $insurance['salesOrders'] = [
                'month' => [
                    'open' => 0,
                    'closed' => 0
                ],
                'quarter' => [
                    'open' => 0,
                    'closed' => 0
                ],
                'half_year' => [
                    'open' => 0,
                    'closed' => 0
                ],
                'year' => [
                    'open' => 0,
                    'closed' => 0
                ]
            ];

            # group sales orders by closed - open status
            foreach ($item->salesOrders as $key => $salesOrder) {
                # yearly timeframe
                if($salesOrder->contract_sign_date->year === $currentYear) {
                    if($salesOrder->sales_order_status === 'closing') {
                        $insurance['salesOrders']['year']['closed'] += 1;
                    } else {
                        $insurance['salesOrders']['year']['open'] += 1;
                    }
                }

                # half year timeframe
                if ($salesOrder->contract_sign_date->month >= $halfYearStartMonth && $salesOrder->contract_sign_date->month <= $halfYearEndMonth) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $insurance['salesOrders']['half_year']['closed'] += 1;
                    } else {
                        $insurance['salesOrders']['half_year']['open'] += 1;
                    }
                }

                # quarterly timeframe
                if ($salesOrder->contract_sign_date->month >= $quarterStartMonth && $salesOrder->contract_sign_date->month <= $quarterEndMonth) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $insurance['salesOrders']['quarter']['closed'] += 1;
                    } else {
                        $insurance['salesOrders']['quarter']['open'] += 1;
                    }
                }

                # monthly timeframe
                if ($salesOrder->contract_sign_date->month === $currentMonth) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $insurance['salesOrders']['month']['closed'] += 1;
                    } else {
                        $insurance['salesOrders']['month']['open'] += 1;
                    }
                }
            }
            
            # add the insurance to the array
            array_push($salesOrderByTimeframeForEachInsurance, $insurance);
        }

        return response()->json([
            'insurances' => $salesOrderByTimeframeForEachInsurance,
            'numOfPages' => $insurances->lastPage(),
            'currentPage' => $insurances->currentPage()
        ]);
    }
}
