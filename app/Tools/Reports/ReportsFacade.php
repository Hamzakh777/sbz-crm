<?php 
 
namespace App\Tools\Reports;

use Illuminate\Support\Facades\Facade;

class ReportsFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'reports';
    }
}
