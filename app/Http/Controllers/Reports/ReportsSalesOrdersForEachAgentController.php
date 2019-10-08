<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;

class ReportsSalesOrdersForEachAgentController extends Controller
{
    public function index(Request $request) {
        $currentYear = now()->year;

        $salesOrders = SalesOrder::select('sales_user_id', 'id', 'sales_order_status')
            ->whereNotNull('sales_user_id')
            ->with(['salesAgent'])
            ->whereYear('contract_sign_date', $currentYear)
            ->get();

        # group by sales agent
        $salesOrderBySalesAgent = [];
        foreach ($salesOrders as $key => $salesOrder) {
            $username = $salesOrder->salesAgent->username;
            $salesOrderBySalesAgent[$username] = [
                'openSalesOrders' => 0,
                'closedSalesOrders' => 0
            ];
        }

        foreach ($salesOrders as $key => $salesOrder) {
            if ($salesOrder->sales_order_status === 'closing') {
                $salesOrderBySalesAgent[$username]['closedSalesOrders'] += 1;
            } else {
                $salesOrderBySalesAgent[$username]['openSalesOrders'] += 1;
            }
        }


        # group by month - quarter - half year - year
        
        return $salesOrderBySalesAgent;
    }
}
