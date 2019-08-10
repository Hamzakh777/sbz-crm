<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * A task belongs to a task collection
     */
    public function taskCollection() {
        $this->belongsTo('App\Taskscollection', 'task_collection_id');
    }
}
