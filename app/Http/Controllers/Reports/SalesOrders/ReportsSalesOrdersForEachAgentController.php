<?php

namespace App\Http\Controllers\Reports\SalesOrders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;
use App\User;
use TCG\Voyager\Models\Role;

class ReportsSalesOrdersForEachAgentController extends Controller
{
    public function index(Request $request) {
        $currentYear = (int)now()->year;
        $currentMonth = (int)now()->month;
        $quarterStartMonth = now()->firstOfQuarter()->month;
        $quarterEndMonth = now()->lastOfQuarter()->month;
        $halfYearStartMonth = now()->month >= 7 ? 7 : 1;
        $halfYearEndMonth = now()->month >= 7 ? 12 : 6;

        $salesAgentRole = Role::where('name', 'sales_person')->first();
        $salesAgents = User::select(['id', 'username'])
            ->where('role_id', $salesAgentRole->id)
            ->with(['agentSalesOrders' => function($query) use ($currentYear){
                $query->whereYear('contract_sign_date', $currentYear)
                ->select(['id', 'sales_user_id', 'sales_order_status', 'contract_sign_date']);
            }]) 
            ->withCount(['agentSalesOrders as agentSalesOrders_count' => function ($query) use ($currentYear) {
                return $query->whereYear('contract_sign_date', $currentYear);
            }])
            ->orderByRaw('agentSalesOrders_count desc')
            ->paginate(7);


        # group by timeFrame - current month / quarter / half_year / year 
        $salesOrderByTimeframeForSalesAgents = [];
        foreach ($salesAgents as $key => $salesAgent) {
            $agent = [];
            $agent['username'] = $salesAgent->username;

            $agent['salesOrders'] = [
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
            foreach ($salesAgent->agentSalesOrders as $key => $salesOrder) {
                # yearly timeframe
                if($salesOrder->contract_sign_date->year === $currentYear) {
                    if($salesOrder->sales_order_status === 'closing') {
                        $agent['salesOrders']['year']['closed'] += 1;
                    } else {
                        $agent['salesOrders']['year']['open'] += 1;
                    }
                }

                # half year timeframe
                if ($salesOrder->contract_sign_date->month >= $halfYearStartMonth && $salesOrder->contract_sign_date->month <= $halfYearEndMonth) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $agent['salesOrders']['half_year']['closed'] += 1;
                    } else {
                        $agent['salesOrders']['half_year']['open'] += 1;
                    }
                }

                # quarterly timeframe
                if ($salesOrder->contract_sign_date->month >= $quarterStartMonth && $salesOrder->contract_sign_date->month <= $quarterEndMonth) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $agent['salesOrders']['quarter']['closed'] += 1;
                    } else {
                        $agent['salesOrders']['quarter']['open'] += 1;
                    }
                }

                # monthly timeframe
                if ($salesOrder->contract_sign_date->month === $currentMonth) {
                    if ($salesOrder->sales_order_status === 'closing') {
                        $agent['salesOrders']['month']['closed'] += 1;
                    } else {
                        $agent['salesOrders']['month']['open'] += 1;
                    }
                }
            }
            
            # add the agent to the array
            array_push($salesOrderByTimeframeForSalesAgents, $agent);
        }
        
        return response()->json([
            'salesAgents' => $salesOrderByTimeframeForSalesAgents,
            'numOfPages' => $salesAgents->lastPage(),
            'currentPage' => $salesAgents->currentPage()
        ]);
    }
}
