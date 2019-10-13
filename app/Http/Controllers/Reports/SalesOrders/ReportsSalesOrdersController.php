<?php

namespace App\Http\Controllers\Reports\SalesOrders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsSalesOrdersController extends Controller
{
    private function salesOrders() {

    }

    public function index(Request $request) {
        $timeframe = (string)$request->query('timeframe');

        // sales orders by status - year 
        $salesOrders = SalesOrder::whereYear('contract_sign_date', now()->year)->get();
        $salesOrdersByStatusYearly = [
            'entry' => 0,
            'processing' => 0,
            'closing' => 0
        ];

        foreach ($salesOrders as $key => $salesOrder) {
            switch ($salesOrder->sales_order_status) {
                case 'entry':
                    $salesOrdersByStatusYearly['entry'] += 1;
                    break;

                case 'processing':
                    $salesOrdersByStatusYearly['processing'] += 1;
                    break;

                case 'closing':
                    $salesOrdersByStatusYearly['closing'] += 1;
                    break;

            }
        }

        // sales order by status - won/not won
        $currentyear = now()->year;
        $salesOrdersByMonth = [];
        $salesOrdersByStatusForEachMonth = [];

        switch ($timeframe) {
            case 'quarter':
                # get start and end month of the quarter
                $quarterStart = now()->firstOfQuarter();
                $quarterEnd = now()->lastOfQuarter();
                
                $salesOrdersByMonth = SalesOrder::whereDate('contract_sign_date', '>=', $quarterStart)
                    ->where('contract_sign_date', '<=', $quarterEnd)
                    ->whereYear('contract_sign_date', $currentyear)
                    ->orderBy('contract_sign_date', 'desc')
                    ->get()
                    ->groupBy(function ($d) {
                        return Carbon::parse($d->contract_sign_date)->format('m');
                    });

                break;

            case 'half_year':
                // to determine if we are on the first or second part of the year
                $month = now()->month >= 7 ? 6 : 1;
                
                $salesOrdersByMonth = SalesOrder::whereMonth('contract_sign_date', '>=', $month)
                    ->whereMonth('contract_sign_date', '<=', $month + 6)
                    ->whereYear('contract_sign_date', $currentyear)
                    ->orderBy('contract_sign_date', 'desc')
                    ->get()
                    ->groupBy(function ($d) {
                        return Carbon::parse($d->contract_sign_date)->format('m');
                    });

                break;

            case 'year':
                $salesOrdersByMonth = SalesOrder::whereYear('contract_sign_date', $currentyear)
                    ->orderBy('contract_sign_date', 'desc')
                    ->get()
                    ->groupBy(function ($d) {
                        return Carbon::parse($d->contract_sign_date)->format('m');
                    });
                break;

            default:
                # raise an exception or error
                break;
        }

        # group the sales orders by month
        foreach ($salesOrdersByMonth as $month => $salesOrders) {
            # $key is the month in this case
            $salesOrdersByStatusForEachMonth[$month] = [
                'open'  => 0,
                'closed' => 0
            ];

            foreach ($salesOrders as $key => $salesOrder) {
                # code...
                if($salesOrder->sales_order_status !== 'closing') {
                    // open
                    $salesOrdersByStatusForEachMonth[$month]['open'] += 1;
                } else {
                    $salesOrdersByStatusForEachMonth[$month]['closed'] += 1;
                }
            }
        }

        # to sort the array in ascending order by key ( which is the month in our case )
        ksort($salesOrdersByStatusForEachMonth);
        
        # sales order by status for each agent
        
        return response()->json([
            'salesOrdersByStatusYearly' => $salesOrdersByStatusYearly,
            'salesOrdersByStatusForEachMonth' => $salesOrdersByStatusForEachMonth
        ]);
    }
}
