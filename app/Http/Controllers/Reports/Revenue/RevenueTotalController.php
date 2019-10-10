<?php

namespace App\Http\Controllers\Reports\Revenue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;

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

        switch ($timeframe) {
            case 'month':
                $salesOrders = SalesOrder::has('compensation')
                    ->with('compensation')
                    ->whereYear('contract_sign_date', $currentYear)
                    ->whereMonth('contract_sign_date', $currentMonth)
                    ->get();

                break;

            case 'month':
                $salesOrders = SalesOrder::has('compensation')
                    ->with('compensation')
                    ->whereYear('contract_sign_date', $currentYear)
                    ->whereMonth('contract_sign_date', $currentMonth)
                    ->get();

                break;
            
            default:
                # code...
                break;
        }
    }
}
