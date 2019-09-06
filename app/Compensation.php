<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compensation extends Model
{
    protected $table = 'compensations';

    public function salesOrder() {
        return $this->belongsTo('App\SalesOrder', 'sales_order_id');
    }
}
