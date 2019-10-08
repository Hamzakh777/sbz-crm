<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;

class ReportsSalesOrdersForEachAgentController extends Controller
{
    public function index(Request $request) {
        $currentYear = now()->year;

        $salesOrders = SalesOrder::where('contract_sign_date', $currentYear)->get();

        
    }
}
