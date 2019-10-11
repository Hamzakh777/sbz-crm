<?php

namespace App\Http\Controllers\Reports\Insurance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsInsuranceController extends Controller
{
    /**
     * For each Insurance we group the salesorders by 
     * status and by timeframe
     */
    public function index() {
        $currentYear = (int) now()->year;
        $currentMonth = (int) now()->month;
        $quarterStartMonth = now()->firstOfQuarter()->month;
        $quarterEndMonth = now()->lastOfQuarter()->month;
        $halfYearStartMonth = now()->month >= 7 ? 7 : 1;
        $halfYearEndMonth = now()->month >= 7 ? 12 : 6;

        
    }
}
