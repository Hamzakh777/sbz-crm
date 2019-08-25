<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * many to many relationship
     * 
     */
    public function contractPeople() {
        $this->belongsToMany('App\ContractPerson', 'contract_person_product', 'product_id');
    } 
}
