<?php

namespace AvoRed\Framework\Breadcrumb;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Breadcrumb\Builder;
use AvoRed\Framework\Breadcrumb\Breadcrumb;
use AvoRed\Framework\Support\Facades\Breadcrumb as BreadcrumbFacade;

class BreadcrumbProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service provider.
     * @return void
     */
    public function boot()
    {
        $this->registerBreadcrumb();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('breadcrumb', 'AvoRed\Framework\Breadcrumb\Builder');
    }

    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton(
            'breadcrumb',
            function () {
                return new Builder();
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['breadcrumb', 'AvoRed\Framework\Breadcrumb\Builder'];
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerBreadcrumb()
    {
        BreadcrumbFacade::make(
            'admin.dashboard',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.category.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.category.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.category.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.category.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.category.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.category.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.category.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.category.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion-code.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.promo-code')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion-code.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.promotion-code.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.promotion-code.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion-code.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.promotion-code.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.promotion-code.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.role.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.role')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.role.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.role.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.role.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.role.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.language.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.language.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.language.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.language.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.language.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.language.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.language.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.language.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.property.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.property')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.property.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.property.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.property.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.property.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.order-status.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.order-status.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.order-status.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.order-status.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.order-status.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.order-status.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.order-status.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.order-status.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.status.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.status.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.status.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.status.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.status.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.status.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.status.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.status.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.admin-user.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.admin-user')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.admin-user.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.create-admin-user')
                    ->parent('admin.dashboard')
                    ->parent('admin.admin-user.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.admin-user.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.edit-admin-user')
                    ->parent('admin.dashboard')
                    ->parent('admin.admin-user.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.currency.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.currency')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.currency.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.currency.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.currency.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.currency.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.currency.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.currency.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.page.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.page.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.page.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.page.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.page.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.page.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.page.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.page.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.attribute.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.attribute.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.attribute.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.attribute.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.attribute.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.attribute.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.attribute.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.attribute.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.user-group.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.user-group.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.user-group.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.user-group.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.user-group.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.user-group.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.user-group.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.user-group.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.tax-group.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.tax-group.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.tax-group.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.tax-group.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.tax-group.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.tax-group.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.tax-group.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.user-group.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.tax-rate.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.tax-rate.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.tax-rate.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.tax-rate.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.tax-rate.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.tax-rate.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.tax-rate.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.tax-rate.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.configuration.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.configuration')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.order.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.order.index')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.order.show',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.order.show')
                    ->parent('admin.dashboard')
                    ->parent('admin.order.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.menu-group.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.menu.index')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu-group.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.menu.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.menu-group.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu-group.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.menu.edit')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.menu.index')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.menu.create')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.menu.edit')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.customer.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.customer.index')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.customer.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.customer.create')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.customer.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.customer.edit')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.product.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.product.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.product.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.product.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.product.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.product.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.product.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.product.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.state.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.state.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.state.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.state.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.state.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.state.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.state.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.state.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion.code.table',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.promotion-code')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion.code.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.promotion-code-edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.promotion.code.table');
            }
        );
    }
}
