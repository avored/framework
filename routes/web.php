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
use Illuminate\Support\Facades\Route;

$baseAdminUrl = config('avored.admin_url');

Route::middleware(['web'])
    ->prefix($baseAdminUrl)
    ->namespace('AvoRed\\Framework')
    ->name('admin.')
    ->group(function () {
            
        /***************** LOGIN ROUTE *****************/
        Route::get('login', [\AvoRed\Framework\User\Controllers\LoginController::class, 'loginForm'])
            ->name('login');
        Route::post('login', [\AvoRed\Framework\User\Controllers\LoginController::class, 'login'])
            ->name('login.post');
        Route::post('logout', [\AvoRed\Framework\User\Controllers\LoginController::class, 'logout'])
            ->name('logout');

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
    ->namespace('AvoRed\Framework')
    ->name('admin.')
    ->group(function () {
        
        Route::get('', [\AvoRed\Framework\System\Controllers\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('configuration', 'System\Controllers\ConfigurationController@index')
            ->name('configuration.index');
        Route::post('configuration', [\AvoRed\Framework\System\Controllers\ConfigurationController::class, 'store'])
            ->name('configuration.store');

        Route::post('attribute/upload', [\AvoRed\Framework\Catalog\Controllers\AttributeController::class, 'upload'])
            ->name('attribute.upload');

        Route::post('admin-user-image', [\AvoRed\Framework\User\Controllers\AdminUserController::class, 'upload'])
            ->name('admin-user-image-upload');

        Route::post(
            'variation/{product}/create-variation',
            [\AvoRed\Framework\Catalog\Controllers\ProductController::class, 'createVariation']
        )->name('product.create.variation');

        Route::post(
            'variation/{product}/save-variation',
            [\AvoRed\Framework\Catalog\Controllers\ProductController::class, 'saveVariation']
        )->name('product.save.variation');

        Route::delete(
            'variation/{product}',
            [\AvoRed\Framework\Catalog\Controllers\ProductController::class, 'destroyVariation']
        )->name('product.destroy.variation');

        Route::post(
            'product-image/{product}/upload',
            [\AvoRed\Framework\Catalog\Controllers\ProductController::class, 'upload']
        )->name('product.image.upload');
        Route::delete(
            'product-image/{productImage}',
            [\AvoRed\Framework\Catalog\Controllers\ProductController::class, 'destroyImage']
        )->name('product.image.destroy');

        Route::get(
            'order/{order}',
            [\AvoRed\Framework\Order\Controllers\OrderController::class, 'show']
        )->name('order.show');
        Route::post(
            'order-change-status/{order}',
            [\AvoRed\Framework\Order\Controllers\OrderController::class, 'changeStatus']
        )->name('order.change-status');
        Route::post(
            'save-order-track-code/{order}',
            [\AvoRed\Framework\Order\Controllers\OrderController::class, 'saveTrackCode']
        )->name('order.save.track.code');
        Route::get(
            'order-download-invoice/{order}',
            [\AvoRed\Framework\Order\Controllers\OrderController::class, 'downloadInvoice']
        )->name('order.download.invoice');
        Route::get(
            'order-email-invoice/{order}',
            [\AvoRed\Framework\Order\Controllers\OrderController::class, 'emailInvoice']
        )->name('order.email.invoice');
        Route::get(
            'order-shipping-label/{order}',
            [\AvoRed\Framework\Order\Controllers\OrderController::class, 'generateShippingLabel']
        )->name('order.shipping.label');

        Route::post(
            'category/filter',
            [\AvoRed\Framework\Catalog\Controllers\CategoryController::class, 'filter']
        )->name('category.filter');
        Route::post(
            'product/filter',
            [\AvoRed\Framework\Catalog\Controllers\ProductController::class, 'filter']
        )->name('product.filter');
        Route::post(
            'property/filter',
            [\AvoRed\Framework\Catalog\Controllers\PropertyController::class, 'filter']
        )->name('property.filter');
        Route::post(
            'attribute/filter',
            [\AvoRed\Framework\Catalog\Controllers\AttributeController::class, 'filter']
        )->name('attribute.filter');
        Route::post(
            'menu-group/filter',
            [\AvoRed\Framework\Cms\Controllers\MenuGroupController::class, 'filter']
        )->name('menu-group.filter');
        Route::post(
            'page/filter',
            [\AvoRed\Framework\Cms\Controllers\PageController::class, 'filter']
        )->name('page.filter');
        Route::post(
            'menu/filter',
            [\AvoRed\Framework\Cms\Controllers\MenuController::class, 'filter']
        )->name('menu.filter');
        Route::post(
            'order-status/filter',
            [\AvoRed\Framework\Order\Controllers\OrderStatusController::class, 'filter']
        )->name('order-status.filter');
        Route::post(
            'customer-group/filter',
            [\AvoRed\Framework\User\Controllers\CustomerGroupController::class, 'filter']
        )->name('customer-group.filter');
        Route::post(
            'admin-user/filter',
            [\AvoRed\Framework\User\Controllers\AdminUserController::class, 'filter']
        )->name('admin-user.filter');
        Route::post(
            'promotion-code/filter',
            [\AvoRed\Framework\Promotion\Controllers\PromotionController::class, 'filter']
        )->name('promotion-code.filter');
        Route::post(
            'currency/filter',
            [\AvoRed\Framework\System\Controllers\CurrencyController::class, 'filter']
        )->name('currency.filter');
        Route::post(
            'role/filter',
            [\AvoRed\Framework\System\Controllers\RoleController::class, 'filter']
        )->name('role.filter');
        Route::post(
            'order/filter',
            [\AvoRed\Framework\Order\Controllers\OrderController::class, 'filter']
        )->name('order.filter');

        Route::resource('admin-user', User\Controllers\AdminUserController::class);
        Route::resource('attribute', Catalog\Controllers\AttributeController::class);
        Route::resource('category', Catalog\Controllers\CategoryController::class);
        Route::get('category-test', [\AvoRed\Framework\System\Controllers\SpaController::class, 'index']);
        Route::resource('currency', System\Controllers\CurrencyController::class);
        Route::resource('language', System\Controllers\LanguageController::class);
        Route::resource('order', Order\Controllers\OrderController::class)->only(['index']);
        Route::resource('order/{order}/comment/order-comment', Order\Controllers\OrderCommentController::class);
        Route::resource('order-status', Order\Controllers\OrderStatusController::class);
        Route::resource('menu-group', Cms\Controllers\MenuGroupController::class);
        Route::resource('menu-group/{menuGroup}/menu', Cms\Controllers\MenuController::class);
        Route::resource('page', Cms\Controllers\PageController::class);
        Route::resource('property', Catalog\Controllers\PropertyController::class);
        Route::resource('product', Catalog\Controllers\ProductController::class);
        Route::resource('role', System\Controllers\RoleController::class);
        Route::resource('state', System\Controllers\StateController::class);
        Route::resource('customer', User\Controllers\CustomerController::class);
        Route::resource('customer/{customer}/address', User\Controllers\AddressController::class);
        Route::resource('customer-group', User\Controllers\CustomerGroupController::class);
        Route::resource('tax-group', System\Controllers\TaxGroupController::class);
        Route::resource('tax-rate', System\Controllers\TaxRateController::class);

        Route::resource('promotion-code', Promotion\Controllers\PromotionController::class);

        Route::get('report/{identifier}', [\AvoRed\Framework\Report\Controllers\ReportController::class, 'index'])
            ->name('report.index');
        Route::post('report/{identifier}', [\AvoRed\Framework\Report\Controllers\ReportController::class, 'results'])
            ->name('report.post');
    // Route::get(
        //     'promotion-code-edit/{promotionCode?}',
        //     Promotion\Controllers\PromotionCode\EditController::class
        // )->name('promotion.code.edit');
        // Route::post(
        //     'promotion-code-save/{promotionCode?}',
        //     Promotion\Controllers\PromotionCode\SaveController::class
        // )->name('promotion.code.save');
        // Route::delete('promotion-code/{promotionCode}', Promotion\Controllers\PromotionCode\DestroyController::class)
        //     ->name('promotion.code.destroy');
    });
