<?php

namespace App\Http\Controllers\Reports\Revenue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;
use Carbon\Carbon;

class RevenueOpenShareController extends Controller
{
    public function index(Request $request)
    {   
        $timeframe = (string) $request->query('timeframe');

        $currentYear = (int) now()->year;
        $currentMonth = (int) now()->month;
        $quarterStartMonth = now()->firstOfQuarter()->month;
        $quarterEndMonth = now()->lastOfQuarter()->month;
        $halfYearStartMonth = now()->month >= 7 ? 7 : 1;
        $halfYearEndMonth = now()->month >= 7 ? 12 : 6;

        $query = SalesOrder::has('compensation')
            ->select(['id', 'contract_sign_date', 'sales_order_status'])
            ->with([
                'compensation' => function($query) {
                    return $query->select(['id', 'sales_order_id', 'total_provision_paid']);
                }
            ])
            ->whereYear('contract_sign_date', $currentYear);

        switch ($timeframe) {
            case 'month':
                $salesOrders = $query->whereMonth('contract_sign_date', $currentMonth)
                    ->get();

                break;

            case 'quarter':
                $salesOrders =  $query->whereMonth('contract_sign_date', '>=', $quarterStartMonth)
                    ->whereMonth('contract_sign_date', '<=', $quarterEndMonth)
                    ->get();

                break;

            case 'half_year':
                $salesOrders =  $query->whereMonth('contract_sign_date', '>=', $halfYearStartMonth)
                    ->whereMonth('contract_sign_date', '<=', $halfYearEndMonth)
                    ->get();

                break;

            case 'year':
                $salesOrders =  $query->get();

                break;

            default:
                // emty sales orders collection
                $salesOrders = collect();

                break;
        }

        $openProvision = 0;
        $closedProvision = 0;
        
        $salesOrders->each(function($salesOrder, $key) use (&$openProvision, &$closedProvision){
            if($salesOrder->sales_order_status === 'closing') {
                $closedProvision += $salesOrder->compensation->total_provision_paid;
            } else {
                $openProvision += $salesOrder->compensation->total_provision_paid;
            }   
        });  

        return response()->json([
            'openProvision' => $openProvision,
            'closedProvision' => $closedProvision
        ]);
    }
}
