<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksCollection extends Model
{
    /**
     * Task collection has many tasks
     * @param void
     */
    public function tasks() {
        $this->hasMany('App\Task', 'task_collection_id');
    }

    /**
     * Task collection belongs to many sales orders
     * @param void
     */
    public function salesOrders() {
        $this->belongsToMany('App\SalesOrder', 'sales_order_tasks_collection', 'tasks_collection_id');
    }
}
