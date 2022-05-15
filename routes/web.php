<?php

use AvoRed\Framework\System\Controllers\DashboardController;
use AvoRed\Framework\User\Controllers\LoginController;
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
            Route::get('login', [LoginController::class, 'loginForm'])
                ->name('login');
            Route::post('login', [LoginController::class, 'login'])
                ->name('login.post');

            /***************** PASSWORD RESET *****************/
            Route::get(
                'password/reset',
                [\AvoRed\Framework\User\Controllers\ForgotPasswordController::class, 'linkRequestForm']
            )->name('password.request');
            Route::post(
                'password/email',
                [\AvoRed\Framework\User\Controllers\ForgotPasswordController::class, 'sendResetLinkEmail']
            )->name('password.email');

            Route::get(
                'password/reset/{token}',
                [\AvoRed\Framework\User\Controllers\ResetPasswordController::class, 'showResetForm']
            )->name('password.reset');
            Route::post('password/reset', [\AvoRed\Framework\User\Controllers\ResetPasswordController::class, 'reset'])
                ->name('password.update');
    });



Route::middleware(['web', 'admin.auth:admin', 'permission'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->group(function () {
        Route::get('', [DashboardController::class, 'index'])
            ->name('dashboard');
});
