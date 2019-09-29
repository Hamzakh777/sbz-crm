<?php

namespace App\Providers;

use App\Document;
use App\ContractPerson;
use App\Observers\ContractPersonObserver;
use App\Observers\DocumentObserver;
use App\Observers\SalesOrderObserver;
use App\SalesOrder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        SalesOrder::observe(SalesOrderObserver::class);
        Document::observe(DocumentObserver::class);
        ContractPerson::observe(ContractPersonObserver::class);
    }
}
