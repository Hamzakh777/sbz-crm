<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractPerson extends Model
{

    protected $table = 'contract_people';

    /**
     * Models to eager load
     */
    protected $with = ['products'];
    
    /**
     * Each contract person belongs to a contract
     */
    public function contract() {
        return $this->belongsTo('App\SalesOrder', 'sales_order_id');
    }

    /**
     * Each person has many products
     * 
     */
    public function products() {
        return $this->belongsToMany('App\Product', 'contract_person_product', 'contract_person_id');
    }
}
