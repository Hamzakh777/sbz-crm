<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Document extends Model
{
    use Searchable;
    
    protected $table = 'documents';

    /**
     * Each document belongs to a sales order
     */
    public function salesOrder() {
        return $this->belongsTo('App\SalesOrder', 'sales_order_id');
    }
}
