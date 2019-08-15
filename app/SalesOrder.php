<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    /**
     * Sales order has one unique associated document
     */
    public function document() {
        $this->hasOne('App/Document'. 'sales_order_id');
    }

    /**
     * Has many people assiosiated with it
     */
    public function people() {
        $this->hasMany('App\ContractPerson', 'sales_order_id');
    }

    /**
     * Has one task collection
     */
    public function taskCollection() {
        $this->belongsToMany('App\TasksCollection', 'sales_order_tasks_collection', 'sales_order_id');
    }

    /**
     * Scope filter sales orders
     */
    public function scopeFilterSalesOrders($query, $request) {
        return $query;
    }
}
