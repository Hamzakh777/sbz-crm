<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TasksCollection extends Model
{
    use Searchable;
    
    protected $table = 'tasks_collections';
    /**
     * Task collection has many tasks
     * @param void
     */
    public function tasks() {
        return $this->hasMany('App\Task', 'task_collection_id');
    }

    /**
     * Task collection belongs to many sales orders
     * @param void
     */
    public function salesOrders() {
        return $this->belongsToMany('App\SalesOrder', 'sales_order_tasks_collection', 'tasks_collection_id');
    }
}
