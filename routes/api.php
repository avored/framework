<?php
// Auth

Route::prefix('public/api/v1')
    ->middleware(['api'])
    ->namespace("AvoRed\Framework\Api\Controllers")
    ->group(function() {
        Route::post('authenticate', 'AuthController@login');
    });


Route::prefix('api')
    ->middleware(['api', 'multiauth:adminapi'])
    ->namespace("AvoRed\Framework\Api\Controllers")
    ->group(function() {

        Route::get('v1/category', 'CategoryController@index');
        Route::post('v1/category', 'CategoryController@store');
        Route::get('v1/category/{category}', 'CategoryController@show');
        Route::put('v1/category/{category}', 'CategoryController@update');
        Route::delete('v1/category/{category}', 'CategoryController@destroy');

        Route::get('v1/property', 'PropertyController@index');
        Route::post('v1/property', 'PropertyController@store');
        Route::get('v1/property/{property}', 'PropertyController@show');
        Route::put('v1/property/{property}', 'PropertyController@update');
        Route::delete('v1/property/{property}', 'PropertyController@destroy');

        Route::get('v1/attribute', 'AttributeController@index');
        Route::post('v1/attribute', 'AttributeController@store');
        Route::get('v1/attribute/{attribute}', 'AttributeController@show');
        Route::put('v1/attribute/{attribute}', 'AttributeController@update');
        Route::delete('v1/attribute/{attribute}', 'AttributeController@destroy');

        Route::get('v1/page', 'PageController@index');
        Route::post('v1/page', 'PageController@store');
        Route::get('v1/page/{page}', 'PageController@show');
        Route::put('v1/page/{page}', 'PageController@update');
        Route::delete('v1/page/{page}', 'PageController@destroy');

        Route::get('v1/product', 'ProductController@index');
        Route::post('v1/product', 'ProductController@store');
        Route::get('v1/product/{id}', 'ProductController@show');
        Route::put('v1/product/{id}', 'ProductController@update');
        Route::delete('v1/product/{id}', 'ProductController@destroy');

        Route::get('v1/user', 'UserController@index');
        Route::get('v1/user/{user}', 'UserController@show');

        Route::get('v1/order', 'OrderController@index');
        Route::get('v1/order/{order}', 'OrderController@show');


    });
