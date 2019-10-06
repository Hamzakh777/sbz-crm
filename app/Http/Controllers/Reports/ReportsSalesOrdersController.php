<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsSalesOrdersController extends Controller
{
    public function index(Request $request) {
        $timeframe = (string)$request->query('timeframe');

        switch ($timeframe) {
            case 'month':
                # code...
                break;
            
            default:
                # code...
                break;
        }
        return 'test';
    }
}
