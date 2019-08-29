<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    /**
     * Pagination
     */
    protected $perPage = 15;

    /**
     * Fields that should be instances of Carbon
     */
    protected $dates = ['contract_duration_VVG', 'contract_duration_KVG', 'insurance_submitted_date'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['documents', 'people', 'comments', 'tasksCollections'];

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
        $salesOrderCompleted = $request->input('salesOrder');

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
            ->when($contractStartYear, function ($data, $contractStartYear) {
                return $data->where('contract_start_VVG', $contractStartYear);
            });
    }
}