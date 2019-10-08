<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;
use App\User;
use TCG\Voyager\Models\Role;

class ReportsSalesOrdersForEachAgentController extends Controller
{
    public function index(Request $request) {
        $currentYear = now()->year;

        $salesAgentRole = Role::where('name', 'sales_person')->first();
        $salesAgents = User::
            select(['id', 'username'])
            ->where('role_id', $salesAgentRole->id)
            ->withCount('agentSalesOrders')->get();

        # group by sales agent
        $salesOrderBySalesAgent = [];
        // foreach ($salesOrders as $key => $salesOrder) {
        //     $username = $salesOrder->salesAgent->username;
        //     $salesOrderBySalesAgent[$username] = [
        //         'openSalesOrders' => 0,
        //         'closedSalesOrders' => 0
        //     ];
        // }

        // foreach ($salesOrders as $key => $salesOrder) {
        //     if ($salesOrder->sales_order_status === 'closing') {
        //         $salesOrderBySalesAgent[$username]['closedSalesOrders'] += 1;
        //     } else {
        //         $salesOrderBySalesAgent[$username]['openSalesOrders'] += 1;
        //     }
        // }


        # group by month - quarter - half year - year
        
        return $salesAgents;
    }
}
