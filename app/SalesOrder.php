<?php

namespace App;

use Bkwld\Cloner\Cloneable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SalesOrder extends Model
{
    use Cloneable;
    // use Searchable;
    
    /**
     * Which relationships to clone with the model
     */
    protected $cloneable_relations = ['comments', 'tasksCollections', 'compensation'];

    /**
     * Pagination
     */
    protected $perPage = 15;

    /**
     * Fields that should be instances of Carbon
     */
    protected $dates = ['contract_start_KVG', 'contract_start_VVG', 'insurance_submitted_date', 'contract_sign_date'];

    /**
     * Sales order has one unique associated document
     */
    public function documents() {
        return $this->hasMany('App\Document', 'sales_order_id');
    }

    /**
     * Has many people assiosiated with it
     */
    public function people() {
        return $this->hasMany('App\ContractPerson', 'sales_order_id');
    }

    /**
     * Has one task collection
     */
    public function tasksCollections() {
        return $this->belongsToMany('App\TasksCollection', 'sales_order_tasks_collection', 'sales_order_id');
    }

    /**
     * Has many comments
     */
    public function comments() {
        return $this->hasMany('App\Comment', 'sales_order_id');
    }

    /**
     * Has one compensation
     */
    public function compensation() {
        return $this->hasOne('App\Compensation', 'sales_order_id');
    }

    /**
     * Has one sales agent
     */
    public function salesAgent() {
        return $this->belongsTo('App\User', 'sales_user_id');
    }

    /**
     * Scope filter sales orders
     */
    public function scopeFilterSalesOrders($query, $request) {
        $salesDateFrom = $request->input('salesDateFrom');
        $salesDateTo = $request->input('salesDateTo');
        $salesOrderStatus = $request->input('salesOrderStatus');
        $insuranceStatus = $request->input('insuranceStatus');
        $salesUserId = $request->input('salesUserId');
        $insuranceId = $request->input('insuranceId');
        $contractStartYear = $request->input('contractStartYear');
        $salesOrderCompleted = $request->input('salesOrderCompleted');

        if ($salesDateFrom != null) {
            $salesDateFrom = Carbon::parse($salesDateFrom, 'Europe/London')->format('Y-m-d');
        }
        if ($salesDateTo != null) {
            $salesDateTo = Carbon::parse($salesDateTo, 'Europe/London')->format('Y-m-d');
        }

        return $query
            ->when($salesDateFrom ,function($data, $salesDateFrom){
                return $data->where('contract_sign_date', '>=', $salesDateFrom);
            })
            ->when($salesDateTo, function ($data, $salesDateTo) {
            return $data->where('contract_sign_date', '<=', $salesDateTo);
            })
            ->when($salesOrderStatus, function ($data, $salesOrderStatus) {
                return $data->where('sales_order_status', $salesOrderStatus);
            })
            ->when($insuranceStatus ,function($data, $insuranceStatus){
                return $data->where('insurance_status', $insuranceStatus);
            })
            ->when($salesUserId, function ($data, $salesUserId) {
                return $data->where('sales_user_id', $salesUserId);
            })
            ->when($insuranceId, function ($data, $insuranceId) {
                return $data->where('new_insurance_id', $insuranceId);
            })
            ->when($salesOrderCompleted, function($data) {
                return $data->where('sales_order_status', 'closed');
            })
            ->when($contractStartYear, function ($data, $contractStartYear) {
                return $data->where('contract_start_VVG', $contractStartYear);
            });
    }
}
