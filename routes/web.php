<?php

$baseAdminUrl = config('avored-framework.admin_url');

Route::middleware(['web'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->namespace('AvoRed\Framework')
    ->group(function() {
        Route::get('login', 'User\Controllers\LoginController@loginForm')->name('login');
        Route::post('login', 'User\Controllers\LoginController@login')->name('login.post');

        Route::get('logout', 'User\Controllers\LoginController@logout')->name('logout');

        Route::get('password/reset/{token}', 'User\Controllers\ResetPasswordController@showResetForm')->name('password.reset.token');
        Route::post('password/email', 'User\Controllers\ForgotPasswordController@sendResetLinkEmail')->name('password.email.post');

        Route::get('password/reset', 'User\Controllers\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'User\Controllers\ResetPasswordController@reset')->name('password.reset.token');
    });

Route::middleware(['web', 'admin.auth', 'permission'])
//Route::middleware(['web'])
->prefix($baseAdminUrl)
->name('admin.')
->namespace('AvoRed\Framework')
->group(function() {
    Route::get('', 'System\Controllers\DashboardController@index')
                ->name('dashboard');

    Route::resource('page', 'Cms\Controllers\PageController');
    Route::resource('user-group', 'User\Controllers\UserGroupController');
    Route::resource('user', 'User\Controllers\UserController');
    Route::resource('attribute', 'Product\Controllers\AttributeController');
    Route::resource('category', 'Product\Controllers\CategoryController');
    Route::resource('product', 'Product\Controllers\ProductController');
    Route::resource('property', 'Product\Controllers\PropertyController');
    Route::resource('order-status', 'Product\Controllers\OrderStatusController');
    Route::resource('role', 'System\Controllers\RoleController');
    Route::resource('site-currency', 'System\Controllers\SiteCurrencyController');
    Route::resource('admin-user', 'System\Controllers\AdminUserController');
    Route::resource('country', 'System\Controllers\CountryController');
    Route::resource('state', 'System\Controllers\StateController');

    Route::post('get-attribute-element', 'Product\Controllers\AttributeController@getElementHtml')
                ->name('attribute.element');
    Route::post('product-attribute-panel', 'Product\Controllers\AttributeController@getAttribute')
                ->name('product-attribute.get-attribute');

    Route::post('get-property-element', 'Product\Controllers\PropertyController@getElementHtml')
                ->name('property.element');

    Route::post(
        'product-image/upload',
                'Product\Controllers\ProductController@uploadImage'
    )
                ->name('product.upload-image');
    Route::post(
        'product-image/delete',
                'Product\Controllers\ProductController@deleteImage'
    )
                ->name('product.delete-image');

    Route::get(
        'product-downloadable-demo/{token}',
                'Product\Controllers\ProductController@downloadDemoToken'
    )
                ->name('product.download.demo.media');
    Route::get(
        'product-downloadable-main/{token}',
                'Product\Controllers\ProductController@downloadMainToken'
    )
                ->name('product.download.main.media');

    Route::post('edit-product-variation', 'Product\Controllers\ProductController@editVariation')
                ->name('variation.edit');

    Route::get('order', 'Order\Controllers\OrderController@index')
                ->name('order.index');

    Route::get('order-return-request', 'Order\Controllers\OrderReturnRequestController@index')
                ->name('order-return-request.index');
    Route::get('order-return-request/{returnRequest}', 'Order\Controllers\OrderReturnRequestController@view')
                ->name('order-return-request.view');
    Route::put('order-return-request/{returnRequest}/update-status/{status}', 'Order\Controllers\OrderReturnRequestController@updateStatus')
                ->name('order-return-request.update-status');

    Route::get('order/{order}', 'Order\Controllers\OrderController@view')
                ->name('order.view');

    Route::get('order/{order}/send-email-invoice', 'Order\Controllers\OrderController@sendEmailInvoice')
                ->name('order.send-email-invoice');
    Route::get('order/{order}/change-status', 'Order\Controllers\OrderController@editStatus')
                ->name('order.change-status');
    Route::put('order/{order}/update-status', 'Order\Controllers\OrderController@updateStatus')
                ->name('order.update-status');

    Route::put('order/{order}/update-track-codes', 'Order\Controllers\OrderController@updateTrackCode')
                ->name('order.update-track-code');

    Route::get('menu', 'Cms\Controllers\MenuController@index')->name('menu.index');
    Route::post('menu', 'Cms\Controllers\MenuController@store')->name('menu.store');

    Route::get('admin-user-detail', 'System\Controllers\AdminUserController@detail')
                ->name('admin-user.detail');
    Route::get('admin-user-api-show', 'System\Controllers\AdminUserController@apiShow')
                ->name('admin-user.show.api');

    Route::get('configuration', 'System\Controllers\ConfigurationController@index')
                ->name('configuration');
    Route::post('configuration', 'System\Controllers\ConfigurationController@store')
                ->name('configuration.store');

    Route::get('module', 'System\Controllers\ModuleController@index')
                ->name('module.index');
    Route::get('module/create', 'System\Controllers\ModuleController@create')
                ->name('module.create');
    Route::post('module', 'System\Controllers\ModuleController@store')
                ->name('module.store');

    Route::get('themes', 'System\Controllers\ThemeController@index')
                ->name('theme.index');
    Route::get('themes/create', 'System\Controllers\ThemeController@create')
                ->name('theme.create');
    Route::post('themes', 'System\Controllers\ThemeController@store')
                ->name('theme.store');

    Route::post('active-themes/{name}', 'System\Controllers\ThemeController@activated')
                ->name('theme.activated');
    Route::post('deactive-themes/{name}', 'System\Controllers\ThemeController@deactivated')
                ->name('theme.deactivated');
    Route::delete('themes/{name}', 'System\Controllers\ThemeController@destroy')
                ->name('theme.destroy');

    Route::get(
        'user/{user}/change-password',
                'User\Controllers\UserController@changePasswordGet'
                )->name('user.change-password');

    Route::put(
        'user/{user}/change-password',
                'User\Controllers\UserController@changePasswordUpdate'
            )->name('user.change-password.update');
});
