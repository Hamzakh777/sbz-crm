<?php

namespace App\Observers;

use App\SalesOrder;

class SalesOrderObserver
{
    /**
     * Handle the sales order "created" event.
     *
     * @param  \App\SalesOrder  $salesOrder
     * @return void
     */
    public function created(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Handle the sales order "updated" event.
     *
     * @param  \App\SalesOrder  $salesOrder
     * @return void
     */
    public function updated(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Handle the sales order "deleted" event.
     *
     * @param  \App\SalesOrder  $salesOrder
     * @return void
     */
    public function deleted(SalesOrder $salesOrder)
    {
        $salesOrder->comments()->delete();
        $salesOrder->compensation()->delete();
        $salesOrder->people()->delete();
    }

    /**
     * Handle the sales order "restored" event.
     *
     * @param  \App\SalesOrder  $salesOrder
     * @return void
     */
    public function restored(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Handle the sales order "force deleted" event.
     *
     * @param  \App\SalesOrder  $salesOrder
     * @return void
     */
    public function forceDeleted(SalesOrder $salesOrder)
    {
        //
    }
}
