<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AvoRed Admin Web Routes
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
    ->group(
        function () {
            // Route::get('', function () { return view('welcome'); })->name('home');
        });
