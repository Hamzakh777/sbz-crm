<?php

namespace App\Http\Controllers\Compensations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;
use App\User;
use PDF;

class CompensationsOverviewPdfController extends Controller
{
    public function index(Request $request) {
        $creator = auth()->user();
        $salesAgent = User::where('id', $request->query('salesAgentId'))->first();
        $salesOrders = SalesOrder::where('sales_user_id', $salesAgent->id);

        $pdf = PDF::loadview('vendor.voyager.compensations.compensations_overview_pdf');

        return $pdf->stream();
    }
}
