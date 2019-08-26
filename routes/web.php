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
        Route::post('sales-orders/pagination', 'SalesOrders\SalesOrderController@pagination')->name('salesOrdersApi.index');

        // Filter the appointments
        Route::post('sales-orders/filter', 'SalesOrders\SalesOrderFilterController@index')->name('salesOrder.filter');

        event(new RoutingAdminAfter());
    });

    event(new RoutingAfter());
});

Route::group([
    'prefix' => 'api',
    'middleware' => 'admin.user'
], function() {
    Route::resources([
        'tasks-collections' => 'TasksCollection\TasksCollectionApiController',
        'tasks' => 'Tasks\ApiTasksController',
        'sales-orders' => 'SalesOrders\ApiSalesOrdersController',
        'documents' => 'Documents\ApiDocumentsController',
        'sales-order-people' => 'SalesOrders\ApiSalesOrderPeopleController',
        'comments' => 'SalesOrders\CommentsController'
    ]);
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
