<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractPerson extends Model
{

    /**
     * Each contract person belongs to a contract
     */
    public function contract() {
        $this->belongsTo('App\SalesOrder', 'contract_id');
    }
}
