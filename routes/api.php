<?php

Route::prefix('api')
    ->middleware(['api','admin.api.auth'])
    ->namespace("AvoRed\Framework\Api\Controllers")
    ->group(function () {
        Route::get('v1/category', 'CategoryController@index');

        Route::post('v1/category', 'CategoryController@store');

        Route::get('v1/category/{category}', 'CategoryController@show');

        Route::put('v1/category/{category}', 'CategoryController@update');

        Route::delete('v1/category/{category}', 'CategoryController@destroy');
    });
