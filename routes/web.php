<?php

use Illuminate\Support\Str;
use TCG\Voyager\Events\Routing;
use TCG\Voyager\Events\RoutingAdmin;
use TCG\Voyager\Events\RoutingAdminAfter;
use TCG\Voyager\Events\RoutingAfter;
use TCG\Voyager\Facades\Voyager;


Auth::routes(['register' => false]);

Voyager::routes();

Route::group(['as' => 'voyager.'], function () {
    event(new Routing());

    $namespacePrefix = '\\' . config('voyager.controllers.namespace') . '\\';
    Route::group(['middleware' => 'admin.user'], function () use ($namespacePrefix) {
        event(new RoutingAdmin());

        // User log
        Route::get('users/{id}/log', 'User\UserLogController@index')->name('user.log');

        Route::get('localisation/{lang}', 'LocalisationController@index')->name('localisation');

        event(new RoutingAdminAfter());
    });

    event(new RoutingAfter());
});
