<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;

class ReportsSalesOrdersController extends Controller
{
    public function index(Request $request) {
        $timeframe = (string)$request->query('timeframe');
        
        switch ($timeframe) {
            case 'month':
                # code...
                break;

            case 'quarter':
                # get start and end month of the quarter
                break;

            case 'month':
                # code...
                break;

            case 'month':
                # code...
                break;

            default:
                # raise an exception or error
                break;
        }
        return 'test';
    }
}
