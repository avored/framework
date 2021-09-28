<?php

namespace AvoRed\Framework\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PermissionProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerPermissions();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->singleton('permission', 'AvoRed\Framework\Permission\Manager');
    }

    /**
     * Register the permission Manager Instance.
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton(
            'permission',
            function () {
                new Manager();
            }
        );
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return ['permission', 'AvoRed\Framework\Permission\Manager'];
    }

    /**
     * Register the permissions.
     * @return void
     */
    protected function registerPermissions()
    {
        $group = Permission::add(
            'dashboard',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.dashboard');
            }
        );
        $group->addPermission(
            'admin-dashboard',
            function (PermissionItem $permission) {
                $permission->label('avored::system.permissions.dashboard')
                    ->routes('admin.dashboard');
            }
        );

        // $configGroup = Permission::add(
        //     'configuration',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.configuration.title');
        //     }
        // );

        // $configGroup->addPermission(
        //     'admin-configuration-index',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.configuration.view')
        //             ->routes('admin.configuration.index');
        //     }
        // );
        // $configGroup->addPermission(
        //     'admin-configuration-save',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.configuration.edit')
        //             ->routes('admin.configuration.store');
        //     }
        // );

        // $productGroup = Permission::add(
        //     'product',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.product.title');
        //     }
        // );

        // $productGroup->addPermission(
        //     'admin-product-index',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.product.list')
        //             ->routes('admin.product.index');
        //     }
        // );
        // $productGroup->addPermission(
        //     'admin-product-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.product.create')
        //             ->routes('admin.product.create,admin.product.store');
        //     }
        // );
        // $productGroup->addPermission(
        //     'admin-product-edit',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.product.edit')
        //             ->routes('admin.product.edit,admin.product.update');
        //     }
        // );
        // $productGroup->addPermission(
        //     'admin-product-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.product.destroy')
        //             ->routes('admin.product.edit,admin.product.destroy');
        //     }
        // );

        // $orderGroup = Permission::add(
        //     'order',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.order.title');
        //     }
        // );
        // $orderGroup->addPermission(
        //     'admin-order-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order.list')
        //             ->routes('admin.order.index');
        //     }
        // );
        // $orderGroup->addPermission(
        //     'admin-order-change-status',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order.change-status')
        //             ->routes('admin.order.change-status');
        //     }
        // );
        // $orderGroup->addPermission(
        //     'admin-order-sent-invoice-by-mail',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order.sent-invoice-by-mail')
        //             ->routes('admin.order.email.invoice');
        //     }
        // );
        // $orderGroup->addPermission(
        //     'admin-order-shipping-label',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order.shipping-label')
        //             ->routes('admin.order.shipping.label');
        //     }
        // );
        // $orderGroup->addPermission(
        //     'admin-download-invoice',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order.download-invoice')
        //             ->routes('admin.order.download.invoice');
        //     }
        // );
        // $orderGroup->addPermission(
        //     'admin-save=tracking-code',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order.save-tracking-code')
        //             ->routes('admin.order.save.track.code');
        //     }
        // );
        // $orderGroup->addPermission(
        //     'admin-order-view',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order.view')
        //             ->routes('admin.order.create,admin.order.view');
        //     }
        // );

        $group = Permission::add(
            'category',
            function (PermissionGroup $group) {
                $group->label('avored::system.category');
            }
        );
        $group->addPermission(
            'admin-category-list',
            function (PermissionItem $permission) {
                $permission->label('avored::system.list')
                    ->routes('admin.category.index');
            }
        );
        $group->addPermission(
            'admin-category-create',
            function (PermissionItem $permission) {
                $permission->label('avored::system.create')
                    ->routes('admin.category.create,admin.category.store');
            }
        );
        $group->addPermission(
            'admin-category-update',
            function (PermissionItem $permission) {
                $permission->label('avored::system.edit')
                    ->routes('admin.category.edit,admin.category.update');
            }
        );
        $group->addPermission(
            'admin-category-destroy',
            function (PermissionItem $permission) {
                $permission->label('avored::system.destroy')
                    ->routes('admin.category.destroy');
            }
        );

        // $group = Permission::add(
        //     'language',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.language.title');
        //     }
        // );
        // $group->addPermission(
        //     'admin-language-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.language.list')
        //             ->routes('admin.language.index');
        //     }
        // );
        // $group->addPermission(
        //     'admin-language-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.language.create')
        //             ->routes('admin.language.create,admin.language.store');
        //     }
        // );
        // $group->addPermission(
        //     'admin-language-update',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.language.edit')
        //             ->routes('admin.language.edit,admin.language.update');
        //     }
        // );
        // $group->addPermission(
        //     'admin-language-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.language.destroy')
        //             ->routes('admin.language.destroy');
        //     }
        // );
        $group = Permission::add(
            'admin-user',
            function (PermissionGroup $group) {
                $group->label('avored::system.staff');
            }
        );
        $group->addPermission(
            'admin-admin-user-list',
            function (PermissionItem $permission) {
                $permission->label('avored::system.list')
                    ->routes('admin.admin-user.index');
            }
        );
        $group->addPermission(
            'admin-admin-user-create',
            function (PermissionItem $permission) {
                $permission->label('avored::system.create')
                    ->routes('admin.admin-user.create,admin.admin-user.store');
            }
        );
        $group->addPermission(
            'admin-admin-user-update',
            function (PermissionItem $permission) {
                $permission->label('avored::system.edit')
                    ->routes('admin.admin-user.edit,admin.admin-user.update');
            }
        );
        $group->addPermission(
            'admin-admin-user-destroy',
            function (PermissionItem $permission) {
                $permission->label('avored::system.destroy')
                    ->routes('admin.admin-user.destroy');
            }
        );
        // $group = Permission::add(
        //     'currency',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.currency.title');
        //     }
        // );
        // $group->addPermission(
        //     'admin-currency-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.currency.list')
        //             ->routes('admin.currency.index');
        //     }
        // );
        // $group->addPermission(
        //     'admin-currency-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.currency.create')
        //             ->routes('admin.currency.create,admin.currency.store');
        //     }
        // );
        // $group->addPermission(
        //     'admin-currency-update',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.currency.edit')
        //             ->routes('admin.currency.edit,admin.currency.update');
        //     }
        // );
        // $group->addPermission(
        //     'admin-currency-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.currency.destroy')
        //             ->routes('admin.currency.destroy');
        //     }
        // );
        // $group = Permission::add(
        //     'order-status',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.order-status.title');
        //     }
        // );
        // $group->addPermission(
        //     'admin-order-status-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order-status.list')
        //             ->routes('admin.order-status.index');
        //     }
        // );
        // $group->addPermission(
        //     'admin-order-status-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order-status.create')
        //             ->routes('admin.order-status.create,admin.order-status.store');
        //     }
        // );
        // $group->addPermission(
        //     'admin-order-status-update',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order-status.edit')
        //             ->routes('admin.order-status.edit,admin.order-status.update');
        //     }
        // );
        // $group->addPermission(
        //     'admin-order-status-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.order-status.destroy')
        //             ->routes('admin.order-status.destroy');
        //     }
        // );

        // $group = Permission::add(
        //     'page',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.page.title');
        //     }
        // );
        // $group->addPermission(
        //     'admin-page-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.page.list')
        //             ->routes('admin.page.index');
        //     }
        // );
        // $group->addPermission(
        //     'admin-page-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.page.create')
        //             ->routes('admin.page.create,admin.page.store');
        //     }
        // );
        // $group->addPermission(
        //     'admin-page-update',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.page.edit')
        //             ->routes('admin.page.edit,admin.page.update');
        //     }
        // );
        // $group->addPermission(
        //     'admin-page-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.page.destroy')
        //             ->routes('admin.page.destroy');
        //     }
        // );

        $group = Permission::add(
            'role',
            function (PermissionGroup $group) {
                $group->label('avored::system.role');
            }
        );

        $group->addPermission(
            'admin-role-list',
            function (PermissionItem $permission) {
                $permission->label('avored::system.list')
                    ->routes('admin.role.index');
            }
        );
        $group->addPermission(
            'admin-role-create',
            function (PermissionItem $permission) {
                $permission->label('avored::system.create')
                    ->routes('admin.role.create,admin.role.store');
            }
        );
        $group->addPermission(
            'admin-role-update',
            function (PermissionItem $permission) {
                $permission->label('avored::system.edit')
                    ->routes('admin.role.edit,admin.role.update');
            }
        );
        $group->addPermission(
            'admin-role-destroy',
            function (PermissionItem $permission) {
                $permission->label('avored::system.destroy')
                    ->routes('admin.role.destroy');
            }
        );

        // $group = Permission::add(
        //     'state',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.state.title');
        //     }
        // );

        // $group->addPermission(
        //     'admin-state-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.state.list')
        //             ->routes('admin.state.index');
        //     }
        // );
        // $group->addPermission(
        //     'admin-state-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.state.create')
        //             ->routes('admin.state.create,admin.state.store');
        //     }
        // );
        // $group->addPermission(
        //     'admin-state-update',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.state.edit')
        //             ->routes('admin.state.edit,admin.state.update');
        //     }
        // );
        // $group->addPermission(
        //     'admin-state-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.state.destroy')
        //             ->routes('admin.state.destroy');
        //     }
        // );

        // $group = Permission::add(
        //     'property',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.property.title');
        //     }
        // );

        // $group->addPermission(
        //     'admin-property-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.property.list')
        //             ->routes('admin.property.index');
        //     }
        // );
        // $group->addPermission(
        //     'admin-property-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.property.create')
        //             ->routes('admin.property.create,admin.property.store');
        //     }
        // );
        // $group->addPermission(
        //     'admin-property-update',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.property.edit')
        //             ->routes('admin.property.edit,admin.property.update');
        //     }
        // );
        // $group->addPermission(
        //     'admin-property-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.property.destroy')
        //             ->routes('admin.property.destroy');
        //     }
        // );

        // $group = Permission::add(
        //     'attribute',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.attribute.title');
        //     }
        // );

        // $group->addPermission(
        //     'admin-attribute-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.attribute.list')
        //             ->routes('admin.attribute.index');
        //     }
        // );
        // $group->addPermission(
        //     'admin-attribute-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.attribute.create')
        //             ->routes('admin.attribute.create,admin.attribute.store');
        //     }
        // );
        // $group->addPermission(
        //     'admin-attribute-update',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.attribute.edit')
        //             ->routes('admin.attribute.edit,admin.attribute.update');
        //     }
        // );
        // $group->addPermission(
        //     'admin-attribute-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.attribute.destroy')
        //             ->routes('admin.attribute.destroy');
        //     }
        // );
        // $group = Permission::add(
        //     'user-group',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.user-group.title');
        //     }
        // );

        // $group->addPermission(
        //     'admin-user-group-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.user-group.list')
        //             ->routes('admin.user-group.index');
        //     }
        // );
        // $group->addPermission(
        //     'admin-user-group-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.user-group.create')
        //             ->routes('admin.user-group.create,admin.user-group.store');
        //     }
        // );
        // $group->addPermission(
        //     'admin-user-group-update',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.user-group.edit')
        //             ->routes('admin.user-group.edit,admin.user-group.update');
        //     }
        // );
        // $group->addPermission(
        //     'admin-user-group-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.user-group.destroy')
        //             ->routes('admin.user-group.destroy');
        //     }
        // );
        // $group = Permission::add(
        //     'tax-group',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.tax-group.title');
        //     }
        // );

        // $group->addPermission(
        //     'admin-tax-group-list',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.tax-group.list')
        //             ->routes('admin.tax-group.index');
        //     }
        // );
        // $group->addPermission(
        //     'admin-tax-group-create',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.tax-group.create')
        //             ->routes('admin.tax-group.create,admin.tax-group.store');
        //     }
        // );
        // $group->addPermission(
        //     'admin-tax-group-update',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.tax-group.edit')
        //             ->routes('admin.tax-group.edit,admin.tax-group.update');
        //     }
        // );
        // $group->addPermission(
        //     'admin-tax-group-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.tax-group.destroy')
        //             ->routes('admin.user-group.destroy');
        //     }
        // );
        // $group = Permission::add(
        //     'permission-code',
        //     function (PermissionGroup $group) {
        //         $group->label('avored::system.permissions.promotion-code.title');
        //     }
        // );

        // $group->addPermission(
        //     'admin-promotion-code-table',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.promotion-code.table')
        //             ->routes('admin.promotion.code.table');
        //     }
        // );
        // $group->addPermission(
        //     'admin-promotion-code-edit',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.promotion-code.edit')
        //             ->routes('admin.promotion.code.edit,admin.promotion.code.save');
        //     }
        // );
        // $group->addPermission(
        //     'admin-promotion-code-destroy',
        //     function (PermissionItem $permission) {
        //         $permission->label('avored::system.permissions.promotion-code.destroy')
        //             ->routes('admin.promotion.code.destroy');
        //     }
        // );
       

        Blade::if(
            'hasPermission',
            function ($routeName) {
                $condition = false;
                $user = Auth::guard('admin')->user();
                if (! $user) {
                    $condition = $user->hasPermission($routeName) ?: false;
                }
                $converted_res = ($condition) ? 'true' : 'false';

                return "<?php if ($converted_res): ?>";
            }
        );
    }
}