<?php

use Illuminate\Support\Str;
use TCG\Voyager\Events\Routing;
use TCG\Voyager\Events\RoutingAdmin;
use TCG\Voyager\Events\RoutingAdminAfter;
use TCG\Voyager\Events\RoutingAfter;
use TCG\Voyager\Facades\Voyager;
use KgBot\LaravelLocalization\Facades\ExportLocalizations;


Auth::routes(['register' => false]);

// generating the compensation overview pdf
Route::get('/compensations/overview', 'Compensations\CompensationsOverviewPdfController@index');

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

        // document preview link
        Route::get('documents/{id}/preview', 'Documents\DocumentsPreviewController@show')->name('documents.preview');

        // reports page
        Route::get('reports', 'Reports\ReportsPageController@index');
        event(new RoutingAdminAfter());
    });

    event(new RoutingAfter());
});

Route::group([
    'prefix' => 'api',
    'middleware' => 'admin.user'
], function() {
    Route::resources([
        'tasks-collections' => 'TasksCollection\TasksCollectionController',
        'tasks' => 'Tasks\ApiTasksController',
        'sales-orders' => 'SalesOrders\SalesOrdersController',
        'documents' => 'Documents\ApiDocumentsController',
        'sales-order-people' => 'SalesOrders\SalesOrderPeopleController',
        'comments' => 'SalesOrders\CommentsController',
        'compensations' => 'Compensations\CompensationsController'
    ]);

    // tasks collections in sales orders
    Route::put('/sales-orders/{salesOrderId}/tasks-collections/{tasksCollecId?}', 'SalesOrders\TasksCollectionsController@update');
    Route::get('/sales-orders/{salesOrderId}/tasks-collections', 'SalesOrders\TasksCollectionsController@index');
    
    // people in sales orders
    Route::get('/sales-orders/{salesOrderId}/sales-order-people/', 'SalesOrders\SalesOrderPeopleController@index');

    // compensation in sales ordre
    Route::get('/sales-orders/{salesOrderId}/compensation/', 'SalesOrders\CompensationsController@index');

    // duplicate a sales order
    Route::get('/sales-orders/{id}/duplicate', 'SalesOrders\SalesOrderDuplicateController@index');

    // to download files 
    Route::get('/file-download', 'FileDownloadController@index')->name('document.download');

    // reports
    Route::get('/reports/sales-orders', 'Reports\ReportsSalesOrdersController@index');
    Route::get('/reports/sales-orders-for-each-agent', 'Reports\ReportsSalesOrdersForEachAgentController@index');
    Route::get('/reports/revenue/total-revenue', 'Reports\Revenue\RevenueTotalController@index');
    Route::get('reports/revenue/open-share', 'Reports\Revenue\RevenueOpenShareController@index');
    Route::get('/reports/insurance/sales-orders-for-each-insurance', 'Reports\Insurance\ReportsInsuranceController@index');

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
