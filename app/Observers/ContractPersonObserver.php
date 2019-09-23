<?php

namespace App\Observers;

use App\ContractPerson;

class ContractPersonObserver
{
    /**
     * Handle the contract person "created" event.
     *
     * @param  \App\ContractPerson  $contractPerson
     * @return void
     */
    public function created(ContractPerson $contractPerson)
    {
        //
    }

    /**
     * Handle the contract person "updated" event.
     *
     * @param  \App\ContractPerson  $contractPerson
     * @return void
     */
    public function updated(ContractPerson $contractPerson)
    {
        //
    }

    /**
     * Handle the contract person "deleted" event.
     *
     * @param  \App\ContractPerson  $contractPerson
     * @return void
     */
    public function deleted(ContractPerson $contractPerson)
    {
        //
    }

    /**
     * Handle the contract person "restored" event.
     *
     * @param  \App\ContractPerson  $contractPerson
     * @return void
     */
    public function restored(ContractPerson $contractPerson)
    {
        //
    }

    /**
     * Handle the contract person "force deleted" event.
     *
     * @param  \App\ContractPerson  $contractPerson
     * @return void
     */
    public function forceDeleted(ContractPerson $contractPerson)
    {
        //
    }
}
