<?php

namespace AvoRed\Framework\Breadcrumb;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Breadcrumb\Facade as BreadcrumbFacade;

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerBreadcrumb();
    }

    /**
     * Register the service provider.
     *
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
        $this->app->singleton('breadcrumb', function ($app) {
            return new Builder();
        });
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
        BreadcrumbFacade::make('admin.dashboard', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Dashboard');
        });

        BreadcrumbFacade::make('admin.product.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Product')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.product.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.product.index');
        });

        BreadcrumbFacade::make('admin.product.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.product.index');
        });

        BreadcrumbFacade::make('admin.attribute.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Attribute')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.attribute.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.attribute.index');
        });

        BreadcrumbFacade::make('admin.attribute.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.attribute.index');
        });

        BreadcrumbFacade::make('admin.property.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Property')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.property.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.property.index');
        });

        BreadcrumbFacade::make('admin.attribute.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.attribute.index');
        });

        BreadcrumbFacade::make('admin.order.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Order')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.order.view', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('View')
                ->parent('admin.dashboard')
                ->parent('admin.order.index');
        });

        BreadcrumbFacade::make('admin.theme.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Theme')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.theme.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Upload')
                ->parent('admin.dashboard')
                ->parent('admin.theme.index');
        });

        BreadcrumbFacade::make('admin.role.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Role')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.role.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.role.index');
        });

        BreadcrumbFacade::make('admin.role.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.role.index');
        });

        BreadcrumbFacade::make('admin.admin-user.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Admin User')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.admin-user.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.admin-user.index');
        });

        BreadcrumbFacade::make('admin.admin-user.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.admin-user.index');
        });

        BreadcrumbFacade::make('admin.admin-user.show', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Show')
                ->parent('admin.dashboard')
                ->parent('admin.admin-user.index');
        });

        BreadcrumbFacade::make('admin.configuration', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Configuration')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.category.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Category')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.category.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.category.index');
        });

        BreadcrumbFacade::make('admin.category.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.category.index');
        });
    }
}
