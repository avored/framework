<?php


$baseAdminUrl = config('avored-framework.admin_url');

Route::middleware(['web'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->namespace('AvoRed\Framework')
    ->group(function () {

        Route::get('login', 'User\Controllers\LoginController@loginForm')->name('login');
        Route::post('login', 'User\Controllers\LoginController@login')->name('login.post');

        Route::get('logout', 'User\Controllers\LoginController@logout')->name('logout');

        Route::get('password/reset/{token}', 'User\Controllers\ResetPasswordController@showResetForm')->name('password.reset.token');
        Route::post('password/email', 'User\Controllers\ForgotPasswordController@sendResetLinkEmail')->name('password.email.post');

        Route::get('password/reset', 'User\Controllers\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'User\Controllers\ResetPasswordController@reset')->name('password.reset.token');


    });