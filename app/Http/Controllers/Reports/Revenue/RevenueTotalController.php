<?php

namespace App\Http\Controllers\Reports\Revenue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;
use Carbon\Carbon;

class RevenueTotalController extends Controller
{
    public function index(Request $request) {
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
                    ->get()
                    ->groupBy(function ($d) {
                        return Carbon::parse($d->contract_sign_date)->format('d');
                    });

                break;

            case 'quarter':
                $salesOrders =  $query->whereMonth('contract_sign_date', '>=', $quarterStartMonth)
                    ->whereMonth('contract_sign_date', '<=', $quarterEndMonth)
                    ->get()
                    ->groupBy(function ($d) {
                        return Carbon::parse($d->contract_sign_date)->format('m');
                    });

                break;

            case 'half_year':
                $salesOrders =  $query->whereMonth('contract_sign_date', '>=', $halfYearStartMonth)
                    ->whereMonth('contract_sign_date', '<=', $halfYearEndMonth)
                    ->get()
                    ->groupBy(function ($d) {
                        return Carbon::parse($d->contract_sign_date)->format('m');
                    });

                break;

            case 'year':
                $salesOrders =  $query->get()
                    ->groupBy(function ($d) {
                        return Carbon::parse($d->contract_sign_date)->format('m');
                    });

                break;

            default:
                $salesOrders = collect();

                break;
        }

        // sales orders are grooped by month and day
        // we want to sort them in an asc order
        $sortedSalesOrders = $salesOrders->sortKeys();

        // group the sales orders 
        // and calculate the total provision
        // for each group
        $cols = $sortedSalesOrders->map(function ($item, $key) {
            // each key is a month or day
            // since we are grouping the sales orders 
            // by either months or days
            $dayOrMonth = [
                'openProvision' => 0,
                'closedProvision' => 0
            ];

            foreach ($item as $key => $salesOrder) {
                // group by status
                if($salesOrder->sales_order_status === 'closing') {   
                    $dayOrMonth['closedProvision'] += $salesOrder->compensation->total_provision_paid;
                } else {
                    $dayOrMonth['openProvision'] += $salesOrder->compensation->total_provision_paid;
                }
            }

            return $dayOrMonth;
        });

        return response()->json([
            'cols' => $cols,
            'first' => $cols->first()
        ]);
    }
}
