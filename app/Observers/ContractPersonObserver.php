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
        // remove the associated products
        $contractPerson->products()->detach();

        // delete the associated document
        if (isset($contractPerson->path)) {
            // delete the associated file
            $path = $contractPerson->path;
            $fileExists = Storage::disk('spaces')->exists($path);
            if ($fileExists) {
                Storage::disk('spaces')->delete($path);
            }
        } 
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
