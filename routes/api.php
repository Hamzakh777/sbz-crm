<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('insurance', 'InsuranceController@index');

Route::resources([
    'tasks-collections' => 'TasksCollection\TasksCollectionApiController',
    'tasks' => 'Tasks\ApiTasksController',
    'sales-orders' => 'SalesOrders\ApiSalesOrdersController',
    'documents' => 'Documents\ApiDocumentsController',
    'sales-order-people' => 'SalesOrders\ApiSalesOrderPeopleController'
]);



// Route::post('tasks-collections', 'TasksCollection\TasksCollectionApiController@store');