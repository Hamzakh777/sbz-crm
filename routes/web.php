<?php

use Illuminate\Support\Str;
use TCG\Voyager\Events\Routing;
use TCG\Voyager\Events\RoutingAdmin;
use TCG\Voyager\Events\RoutingAdminAfter;
use TCG\Voyager\Events\RoutingAfter;
use TCG\Voyager\Facades\Voyager;
use KgBot\LaravelLocalization\Facades\ExportLocalizations;


Auth::routes(['register' => false]);

Voyager::routes();

Route::group(['as' => 'voyager.'], function () {
    event(new Routing());

    $namespacePrefix = '\\' . config('voyager.controllers.namespace') . '\\';
    Route::group(['middleware' => 'admin.user'], function () use ($namespacePrefix) {
        event(new RoutingAdmin());

        // User log
        Route::get('users/{id}/log', 'User\UserLogController@index')->name('user.log');

        // Change the local
        Route::get('localisation/{lang}', 'LocalisationController@index')->name('localisation');

        // Sales ordes routes
        Route::post('sales-orders-api', 'SalesOrders\SalesOrderController@index')->name('salesOrdersApi.index');

        event(new RoutingAdminAfter());
    });

    event(new RoutingAfter());
});

if (config('laravel-localization.routes.enable')) {
    /*
     * Localization
     */
    Route::get(config('laravel-localization.routes.prefix'), function () {
        $strings = ExportLocalizations::export()->toFlat();

        return response()->json($strings);
    })->name(config('laravel-localization.routes.name'))
        ->middleware(config('laravel-localization.routes.middleware'));
}
