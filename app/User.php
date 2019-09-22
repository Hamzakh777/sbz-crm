<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    use SoftDeletes;
    // use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'start_date', 'end_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are dates
     * 
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'start_date',
        'end_date'
    ];

    /**
     * MUTATOR
     * The reason for needing this mutator is that
     * mysql only accepts one date format for storing dates
     * so we have to change the format of the date before storing it
     * @param  string  $value
     * @return void
     */
    public function setStartDateAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['start_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    /**
     * MUTATOR
     * The reason for needing this mutator is that
     * mysql only accepts one date format for storing dates
     * so we have to change the format of the date before storing it
     * @param  string  $value
     * @return void
     */
    public function setEndDateAttribute($value)
    {   
        if (isset($value)) {
            dd($value);
            $this->attributes['end_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }
}
