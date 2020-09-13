<?php

namespace AvoRed\Framework\Support\Providers;

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
                $breadcrumb->label('avored::system.breadcrumb.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.category.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.category.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.category.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.category.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.category.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.category.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.category.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.category.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion-code.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.promotion-code.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion-code.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.promotion-code.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.promotion-code.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion-code.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.promotion-code.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.promotion-code.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.role.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.role.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.role.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.role.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.role.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.role.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.role.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.role.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.language.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.language.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.language.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.language.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.language.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.language.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.language.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.language.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.property.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.property.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.property.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.property.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.property.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.property.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.property.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.property.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.order-status.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.order-status.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.order-status.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.order-status.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.order-status.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.order-status.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.order-status.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.order-status.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.status.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.status.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.status.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.status.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.status.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.status.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.status.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.status.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.admin-user.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.admin-user.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.admin-user.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.admin-user.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.admin-user.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.admin-user.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.admin-user.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.admin-user.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.currency.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.currency.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.currency.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.currency.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.currency.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.currency.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.currency.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.currency.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.page.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.page.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.page.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.page.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.page.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.page.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.page.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.page.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.attribute.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.attribute.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.attribute.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.attribute.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.attribute.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.attribute.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.attribute.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.attribute.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.user-group.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.user-group.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.user-group.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.user-group.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.user-group.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.user-group.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.user-group.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.user-group.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.tax-group.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.tax-group.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.tax-group.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.tax-group.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.tax-group.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.tax-group.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.tax-group.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.user-group.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.tax-rate.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.tax-rate.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.tax-rate.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.tax-rate.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.tax-rate.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.tax-rate.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.tax-rate.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.tax-rate.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.configuration.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.configuration')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.order.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.order.index')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.order.show',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.order.show')
                    ->parent('admin.dashboard')
                    ->parent('admin.order.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.menu-group.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.menu.index')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu-group.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.menu.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.menu-group.index');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu-group.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.menu.edit')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.menu.index')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.menu.create')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.menu.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.menu.edit')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.customer.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.customer.index')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.customer.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.customer.create')
                    ->parent('admin.dashboard');
            }
        );
        BreadcrumbFacade::make(
            'admin.customer.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.customer.edit')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.product.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.product.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.product.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.product.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.product.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.product.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.product.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.product.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.state.index',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.state.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.state.create',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.state.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.state.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.state.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.state.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.state.index');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion.code.table',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.promotion-code.index')
                    ->parent('admin.dashboard');
            }
        );

        BreadcrumbFacade::make(
            'admin.promotion.code.edit',
            function (Breadcrumb $breadcrumb) {
                $breadcrumb->label('avored::system.breadcrumb.promotion-code.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.promotion.code.table');
            }
        );
    }
}
