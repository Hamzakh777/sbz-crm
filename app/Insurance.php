<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $table = 'insurances';

    /**
     * An Insurance has many sales orders associated with it
     */
    public function salesOrders() {
        return $this->hasMany('App\SalesOrder', 'new_insurance_id');
    }
}
