<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsPageController extends Controller
{
    public function index() {
        return view('pages.reports.index');
    }
}
