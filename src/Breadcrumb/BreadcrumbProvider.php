<?php

namespace AvoRed\Framework\Breadcrumb;

use Illuminate\Support\ServiceProvider;

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
        Breadcrumb::make(
            'admin.dashboard',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.dashboard');
            }
        );

        Breadcrumb::make(
            'admin.category.index',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.category')
                    ->parent('admin.dashboard');
            }
        );

        Breadcrumb::make(
            'admin.category.create',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.category.index');
            }
        );

        Breadcrumb::make(
            'admin.category.edit',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.category.index');
            }
        );

    //     Breadcrumb::make(
    //         'admin.promotion-code.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.promotion-code.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.promotion-code.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.promotion-code.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.promotion-code.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.promotion-code.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.promotion-code.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.promotion-code.index');
    //         }
    //     );

        Breadcrumb::make(
            'admin.role.index',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.role')
                    ->parent('admin.dashboard');
            }
        );

        Breadcrumb::make(
            'admin.role.create',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.role.index');
            }
        );

        Breadcrumb::make(
            'admin.role.edit',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.role.index');
            }
        );

    //     Breadcrumb::make(
    //         'admin.language.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.language.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.language.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.language.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.language.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.language.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.language.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.language.index');
    //         }
    //     );

        Breadcrumb::make(
            'admin.property.index',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.property')
                    ->parent('admin.dashboard');
            }
        );

        Breadcrumb::make(
            'admin.property.create',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.property.index');
            }
        );

        Breadcrumb::make(
            'admin.property.edit',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.property.index');
            }
        );

        Breadcrumb::make(
            'admin.order-status.index',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.order-status')
                    ->parent('admin.dashboard');
            }
        );

        Breadcrumb::make(
            'admin.order-status.create',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.order-status.index');
            }
        );

        Breadcrumb::make(
            'admin.order-status.edit',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.order-status.index');
            }
        );
    //     Breadcrumb::make(
    //         'admin.status.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.status.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.status.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.status.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.status.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.status.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.status.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.status.index');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.admin-user.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.admin-user.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.admin-user.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.admin-user.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.admin-user.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.admin-user.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.admin-user.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.admin-user.index');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.currency.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.currency.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.currency.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.currency.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.currency.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.currency.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.currency.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.currency.index');
    //         }
    //     );

        Breadcrumb::make(
            'admin.page.index',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.page')
                    ->parent('admin.dashboard');
            }
        );

        Breadcrumb::make(
            'admin.page.create',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.page.index');
            }
        );

        Breadcrumb::make(
            'admin.page.edit',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.page.index');
            }
        );
        Breadcrumb::make(
            'admin.attribute.index',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.attribute')
                    ->parent('admin.dashboard');
            }
        );

        Breadcrumb::make(
            'admin.attribute.create',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.attribute.index');
            }
        );

        Breadcrumb::make(
            'admin.attribute.edit',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.attribute.index');
            }
        );
    //     Breadcrumb::make(
    //         'admin.user-group.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.user-group.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.user-group.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.user-group.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.user-group.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.user-group.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.user-group.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.user-group.index');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.tax-group.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.tax-group.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.tax-group.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.tax-group.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.tax-group.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.tax-group.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.tax-group.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.user-group.index');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.tax-rate.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.tax-rate.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.tax-rate.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.tax-rate.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.tax-rate.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.tax-rate.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.tax-rate.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.tax-rate.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.configuration.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.configuration')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.order.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.order.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.order.show',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.order.show')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.order.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.menu-group.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.menu.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.menu-group.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.menu.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.menu-group.index');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.menu-group.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.menu.edit')
    //                 ->parent('admin.dashboard');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.menu.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.menu.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.menu.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.menu.create')
    //                 ->parent('admin.dashboard');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.menu.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.menu.edit')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.customer.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.customer.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.customer.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.customer.create')
    //                 ->parent('admin.dashboard');
    //         }
    //     );
    //     Breadcrumb::make(
    //         'admin.customer.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.customer.edit')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

        Breadcrumb::make(
            'admin.product.index',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.product')
                    ->parent('admin.dashboard');
            }
        );

        Breadcrumb::make(
            'admin.product.create',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.create')
                    ->parent('admin.dashboard')
                    ->parent('admin.product.index');
            }
        );

        Breadcrumb::make(
            'admin.product.edit',
            function (BreadcrumbItem $breadcrumb) {
                $breadcrumb->label('avored::system.edit')
                    ->parent('admin.dashboard')
                    ->parent('admin.product.index');
            }
        );

    //     Breadcrumb::make(
    //         'admin.state.index',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.state.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.state.create',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.state.create')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.state.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.state.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.state.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.state.index');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.promotion.code.table',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.promotion-code.index')
    //                 ->parent('admin.dashboard');
    //         }
    //     );

    //     Breadcrumb::make(
    //         'admin.promotion.code.edit',
    //         function (BreadcrumbItem $breadcrumb) {
    //             $breadcrumb->label('avored::system.breadcrumb.promotion-code.edit')
    //                 ->parent('admin.dashboard')
    //                 ->parent('admin.promotion.code.table');
    //         }
    //     );
    }
}
