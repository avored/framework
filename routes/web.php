<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$baseAdminUrl = config('avored.admin_url');

Route::middleware(['web'])
    ->prefix($baseAdminUrl)
    ->namespace('AvoRed\\Framework')
    ->name('admin.')
    ->group(function () {

        Route::get('login', 'System\Controllers\LoginController@loginForm')
            ->name('login');
        Route::post('login', 'System\Controllers\LoginController@login')
            ->name('login.post');

        Route::post('logout', 'System\Controllers\LoginController@logout')
            ->name('logout');
        
        //Route::get('password/reset', 'System\Controllers\ForgetPasswordController@showLinkRequestForm')
        //    ->name('password.reset');
    });


Route::middleware(['web', 'admin.auth'])
//Route::middleware(['web'])
    ->prefix($baseAdminUrl)
    ->namespace('AvoRed\\Framework')
    ->name('admin.')
    ->group(function () {
        Route::get('', 'System\Controllers\DashboardController@index')
            ->name('dashboard');

        Route::get('configuration', 'System\Controllers\ConfigurationController@index')
            ->name('configuration.index');
        Route::post('configuration', 'System\Controllers\ConfigurationController@store')
            ->name('configuration.store');
        
        Route::post('admin-user-image', 'System\Controllers\AdminUserController@upload')
            ->name('admin-user-image-upload');

        Route::resource('admin-user', 'System\Controllers\AdminUserController');
        Route::resource('category', 'Catalog\Controllers\CategoryController');
        Route::resource('currency', 'System\Controllers\CurrencyController');
        Route::resource('language', 'System\Controllers\LanguageController');
        Route::resource('order-status', 'Order\Controllers\OrderStatusController');
        Route::resource('page', 'Cms\Controllers\PageController');
        Route::resource('role', 'System\Controllers\RoleController');
        Route::resource('state', 'System\Controllers\StateController');
    });
