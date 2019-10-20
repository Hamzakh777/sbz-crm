<?php

namespace App\Http\Controllers\Reports\Insurance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Insurance;

class ReportsInsuranceRevenueController extends Controller
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

        $insurances = Insurance::select(['name', 'id'])
            ->where('active_partner', 1)
            ->with(['salesOrders' => function ($query) use ($currentYear) {
                return $query
                    ->select(['id', 'new_insurance_id', 'sales_order_status', 'contract_sign_date'])
                    ->has('compensation')
                    ->with(['compensation' => function ($query) {
                        return $query->select(['id', 'sales_order_id', 'total_provision_paid']);
                    }])
                    ->whereYear('contract_sign_date', $currentYear);
            }])
            ->withCount(['salesOrders as salesOrders_count' => function ($query) use ($currentYear) {
                return $query->whereYear('contract_sign_date', $currentYear);
            }])
            ->orderByRaw('salesOrders_count desc')
            ->paginate(7);

        // calcute the revenue for each insurance by timeframe
        $revenueForEachInsurance = [];
        foreach ($insurances as $key => $item) {
            // each item is an insurance
            $insurance = [];
            $insurance['name'] = $item->name;

            $insurance['revenue'] = [
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
                # skip of the sales order has no compensation
                if (!isset($salesOrder->compensation)) {
                    continue;
                }

                # yearly timeframe
                if ($salesOrder->contract_sign_date->year === $currentYear) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $insurance['revenue']['year']['closed'] += $salesOrder->compensation->total_provision_paid;
                    } else {
                        $insurance['revenue']['year']['open'] += $salesOrder->compensation->total_provision_paid;
                    }
                }

                # half year timeframe
                if ($salesOrder->contract_sign_date->month >= $halfYearStartMonth && $salesOrder->contract_sign_date->month <= $halfYearEndMonth) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $insurance['revenue']['half_year']['closed'] += $salesOrder->compensation->total_provision_paid;
                    } else {
                        $insurance['revenue']['half_year']['open'] += $salesOrder->compensation->total_provision_paid;
                    }
                }

                # quarterly timeframe
                if ($salesOrder->contract_sign_date->month >= $quarterStartMonth && $salesOrder->contract_sign_date->month <= $quarterEndMonth) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $insurance['revenue']['quarter']['closed'] += $salesOrder->compensation->total_provision_paid;
                    } else {
                        $insurance['revenue']['quarter']['open'] += $salesOrder->compensation->total_provision_paid;
                    }
                }

                # monthly timeframe
                if ($salesOrder->contract_sign_date->month === $currentMonth) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $insurance['revenue']['month']['closed'] += $salesOrder->compensation->total_provision_paid;
                    } else {
                        $insurance['revenue']['month']['open'] += $salesOrder->compensation->total_provision_paid;
                    }
                }
            }

            # add the insurance to the array
            array_push($revenueForEachInsurance, $insurance);
        }

        return response()->json([
            'revenueForEachInsurance' => $revenueForEachInsurance,
            'numOfPages' => $insurances->lastPage(),
            'currentPage' => $insurances->currentPage()
        ]);
    }
}
