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
        
        Route::get('password/reset', 'System\Controllers\ForgetPasswordController@showLinkRequestForm')
            ->name('password.reset');
    });


Route::middleware(['web', 'admin.auth'])
//Route::middleware(['web'])
    ->prefix($baseAdminUrl)
    ->namespace('AvoRed\\Framework')
    ->name('admin.')
    ->group(function () {
        Route::get('', 'System\Controllers\DashboardController@index')->name('dashboard');

        Route::resource('category', 'Catalog\Controllers\CategoryController');
        Route::resource('language', 'System\Controllers\LanguageController');
        Route::resource('role', 'System\Controllers\RoleController');
    });
