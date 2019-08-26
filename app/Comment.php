<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $with = ['user'];

    public function salesOrder()
    {
        return $this->belongsTo('App\SalesOrder');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
