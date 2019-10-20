<?php 

namespace App\Tools\Reports;

use Carbon\Carbon;
use App\Insurance;

class Reports
{
    public $currentYear;
    public $currentMonth;
    public $quarterStartMonth;
    public $quarterEndMonth;
    public $halfYearStartMonth;
    public $halfYearEndMonth;

    function __construct()
    {
        $this->currentYear = (int) now()->year;
        $this->currentMonth = (int) now()->month;
        $this->quarterStartMonth = now()->firstOfQuarter()->month;
        $this->quarterEndMonth = now()->lastOfQuarter()->month;
        $this->halfYearStartMonth = now()->month >= 7 ? 7 : 1;
        $this->halfYearEndMonth = now()->month >= 7 ? 12 : 6;
    }

    public function insuranceReports()
    {
        $currentYear = $this->currentYear;
        $insurances = Insurance::select(['name', 'id'])
            ->with(['salesOrders' => function ($query) use ($currentYear) {
                return $query
                    ->select(['id', 'new_insurance_id', 'sales_order_status', 'contract_sign_date'])
                    ->whereYear('contract_sign_date', $currentYear);
            }])
            ->withCount(['salesOrders as salesOrders_count' => function ($query) use ($currentYear) {
                return $query->whereYear('contract_sign_date', $currentYear);
            }])
            ->orderByRaw('salesOrders_count desc')
            ->paginate(7);

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
                if ($salesOrder->contract_sign_date->year === $currentYear) {
                    if ($salesOrder->sales_order_status === 'closing') {
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
    }


    
}