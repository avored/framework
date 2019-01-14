<?php

namespace AvoRed\Framework\Permission;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Permission\Facade as PermissionFacade;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class PermissionProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerPermissions();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->singleton('permission', 'AvoRed\Framework\Permission\Manager');
    }

    /**
     * Register the permission Manager Instance.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('permission', function () { new Manager(); });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['permission', 'AvoRed\Framework\Permission\Manager'];
    }

    /**
     * Register the permissions.
     *
     * @return void
     */
    protected function registerPermissions()
    {
        $group = PermissionFacade::add('page', function (PermissionGroup $group) {
            $group->label('Page Permissions');
        });
        $group->addPermission('admin-page-list', function (Permission $permission) {
            $permission->label('Page List')
                    ->routes('admin.page.index');
        });
        $group->addPermission('admin-page-create', function (Permission $permission) {
            $permission->label('Create Page')
                    ->routes('admin.page.create,admin.page.store');
        });
        $group->addPermission('admin-page-update', function (Permission $permission) {
            $permission->label('Update Page')
                    ->routes('admin.page.edit,admin.page.update');
        });
        $group->addPermission('admin-page-destroy', function (Permission $permission) {
            $permission->label('Destroy Page')
                    ->routes('admin.page.destroy');
        });
        $group->addPermission('admin-page-show', function (Permission $permission) {
            $permission->label('Show Page')
                    ->routes('admin.page.show');
        });

        $group = PermissionFacade::add('menu', function (PermissionGroup $group) {
            $group->label('Menu Permissions');
        });

        $group->addPermission('admin-menu-list', function (Permission $permission) {
            $permission->label('Front Menu Index')
                    ->routes('admin.menu.index');
        });

        $group->addPermission('admin-menu-store', function (Permission $permission) {
            $permission->label('Save Front Menu')
                    ->routes('admin.menu.store');
        });

        $group = PermissionFacade::add('category', function (PermissionGroup $group) {
            $group->label('Category Permissions');
        });
        $group->addPermission('admin-category-list', function (Permission $permission) {
            $permission->label('Category List')
                    ->routes('admin.category.index');
        });
        $group->addPermission('admin-category-create', function (Permission $permission) {
            $permission->label('Create Category')
                    ->routes('admin.category.create,admin.category.store');
        });
        $group->addPermission('admin-category-update', function (Permission $permission) {
            $permission->label('Update Category')
                    ->routes('admin.category.edit,admin.category.update');
        });
        $group->addPermission('admin-category-destroy', function (Permission $permission) {
            $permission->label('Destroy Category')
                    ->routes('admin.category.destroy');
        });
        $group->addPermission('admin-category-show', function (Permission $permission) {
            $permission->label('Show Category')
                    ->routes('admin.category.show');
        });

        $group = PermissionFacade::add('product', function (PermissionGroup $group) {
            $group->label('Product Permissions');
        });

        $group->addPermission('admin-product-list', function (Permission $permission) {
            $permission->label('Product List')
                    ->routes('admin.product.index');
        });
        $group->addPermission('admin-product-create', function (Permission $permission) {
            $permission->label('Create Product')
                    ->routes('admin.product.create,admin.product.store');
        });
        $group->addPermission('admin-product-update', function (Permission $permission) {
            $permission->label('Update Product')
                    ->routes('admin.product.edit,admin.product.update');
        });
        $group->addPermission('admin-product-destroy', function (Permission $permission) {
            $permission->label('Destroy Product')
                    ->routes('admin.product.destroy');
        });
        $group->addPermission('admin-product-show', function (Permission $permission) {
            $permission->label('Show Product')
                    ->routes('admin.product.show');
        });

        $group = PermissionFacade::add('order', function (PermissionGroup $group) {
            $group->label('Order Permissions');
        });

        $group->addPermission('admin-order-list', function (Permission $permission) {
            $permission->label('Order List')
                    ->routes('admin.order.index');
        });

        $group->addPermission('admin-order-view', function (Permission $permission) {
            $permission->label('Order View')
                    ->routes('admin.order.view');
        });
        $group->addPermission('admin-order-send-invoice-email', function (Permission $permission) {
            $permission->label('Order Sent Invoice By Email')
                    ->routes('admin.order.send-email-invoice');
        });
        $group->addPermission('admin-order-change-status', function (Permission $permission) {
            $permission->label('Order Change Status')
                    ->routes('admin.order.change-status,admin.order.update-status');
        });

        $group = PermissionFacade::add('order-status', function (PermissionGroup $group) {
            $group->label('Order Status Permissions');
        });
        $group->addPermission('admin-order-status-list', function (Permission $permission) {
            $permission->label('Order Status List')
                    ->routes('admin.order-status.index');
        });
        $group->addPermission('admin-order-status-create', function (Permission $permission) {
            $permission->label('Create Order Status')
                    ->routes('admin.order-status.create,admin.order-status.store');
        });
        $group->addPermission('admin-order-status-update', function (Permission $permission) {
            $permission->label('Update Order Status')
                    ->routes('admin.order-status.edit,admin.order-status.update');
        });
        $group->addPermission('admin-order-status-destroy', function (Permission $permission) {
            $permission->label('Destroy Order Status')
                    ->routes('admin.order-status.destroy');
        });
        $group->addPermission('admin-order-status-show', function (Permission $permission) {
            $permission->label('Show Order Status')
                    ->routes('admin.order-status.show');
        });

        $group = PermissionFacade::add('attribute', function (PermissionGroup $group) {
            $group->label('Attribute Permissions');
        });
        $group->addPermission('admin-attribute-list', function (Permission $permission) {
            $permission->label('Attribute List')
                    ->routes('admin.attribute.index');
        });
        $group->addPermission('admin-attribute-create', function (Permission $permission) {
            $permission->label('Create Attribute')
                    ->routes('admin.attribute.create,admin.attribute.store');
        });
        $group->addPermission('admin-attribute-update', function (Permission $permission) {
            $permission->label('Edit Attribute')
                    ->routes('admin.attribute.edit,admin.attribute.update');
        });
        $group->addPermission('admin-attribute-destroy', function (Permission $permission) {
            $permission->label('Destroy Attribute')
                    ->routes('admin.attribute.destroy');
        });
        $group->addPermission('admin-attribute-show', function (Permission $permission) {
            $permission->label('Show Attribute')
                    ->routes('admin.attribute.show');
        });

        $group = PermissionFacade::add('property', function (PermissionGroup $group) {
            $group->label('Property Permissions');
        });

        $group->addPermission('admin-property-list', function (Permission $permission) {
            $permission->label('Property List')
                    ->routes('admin.property.index');
        });
        $group->addPermission('admin-property-create', function (Permission $permission) {
            $permission->label('Property Create')
                    ->routes('admin.property.create,admin.property.store');
        });
        $group->addPermission('admin-attribute-update', function (Permission $permission) {
            $permission->label('Property Update')
                    ->routes('admin.property.edit,admin.property.update');
        });
        $group->addPermission('admin-property-destroy', function (Permission $permission) {
            $permission->label('Property Destroy')
                    ->routes('admin.property.destroy');
        });
        $group->addPermission('admin-property-show', function (Permission $permission) {
            $permission->label('Property Show')
                    ->routes('admin.property.show');
        });

        $group = PermissionFacade::add('user', function (PermissionGroup $group) {
            $group->label('User Permissions');
        });

        $group->addPermission('admin-user-list', function (Permission $permission) {
            $permission->label('User List')
                    ->routes('admin.user.index');
        });
        $group->addPermission('admin-user-create', function (Permission $permission) {
            $permission->label('User Create')
                    ->routes('admin.user.create,admin.user.store');
        });
        $group->addPermission('admin-user-update', function (Permission $permission) {
            $permission->label('User Update')
                    ->routes('admin.user.edit,admin.user.update');
        });
        $group->addPermission('admin-user-destroy', function (Permission $permission) {
            $permission->label('User Destroy')
                    ->routes('admin.user.destroy');
        });
        $group->addPermission('admin-user-show', function (Permission $permission) {
            $permission->label('User Show')
                    ->routes('admin.user.show');
        });

        $group = PermissionFacade::add('user-group', function (PermissionGroup $group) {
            $group->label('User Group Permissions');
        });

        $group->addPermission('admin-user-group-list', function (Permission $permission) {
            $permission->label('User Group List')
                    ->routes('admin.user-group.index');
        });
        $group->addPermission('admin-user-group-create', function (Permission $permission) {
            $permission->label('User Group Create')
                    ->routes('admin.user-group.create,admin.user-group.store');
        });
        $group->addPermission('admin-user-group.update', function (Permission $permission) {
            $permission->label('User Group Update')
                    ->routes('admin.user-group.edit,admin.user-group.update');
        });
        $group->addPermission('admin-user-group-destroy', function (Permission $permission) {
            $permission->label('User Group Destroy')
                    ->routes('admin.user-group.destroy');
        });
        $group->addPermission('admin-user-group-show', function (Permission $permission) {
            $permission->label('User Group Show')
                    ->routes('admin.user-group.show');
        });

        $group = PermissionFacade::add('admin-user', function (PermissionGroup $group) {
            $group->label('Admin User Permissions');
        });

        $group->addPermission('admin-admin-user-list', function (Permission $permission) {
            $permission->label('Admin User List')
                    ->routes('admin.admin-user.index');
        });
        $group->addPermission('admin-admin-user-create', function (Permission $permission) {
            $permission->label('Admin User Create')
                    ->routes('admin.admin-user.create,admin.admin-user.store');
        });
        $group->addPermission('admin-admin-user-update', function (Permission $permission) {
            $permission->label('Admin User Update')
                    ->routes('admin.admin-user.edit,admin.admin-user.update');
        });
        $group->addPermission('admin-admin-user-destroy', function (Permission $permission) {
            $permission->label('Admin User Destroy')
                    ->routes('admin.admin-user.destroy');
        });
        $group->addPermission('admin-admin-user-show', function (Permission $permission) {
            $permission->label('Admin User Show')
                    ->routes('admin.admin-user.show');
        });

        $group = PermissionFacade::add('role', function (PermissionGroup $group) {
            $group->label('Role Permissions');
        });

        $group->addPermission('admin-role-list', function (Permission $permission) {
            $permission->label('Role List')
                    ->routes('admin.role.index');
        });
        $group->addPermission('admin-role-create', function (Permission $permission) {
            $permission->label('Role Create')
                    ->routes('admin.role.create,admin.role.store');
        });
        $group->addPermission('admin-role-update', function (Permission $permission) {
            $permission->label('Role Update')
                    ->routes('admin.role.edit,admin.role.update');
        });
        $group->addPermission('admin-role-destroy', function (Permission $permission) {
            $permission->label('Role Destroy')
                    ->routes('admin.role.destroy');
        });
        $group->addPermission('admin-role-show', function (Permission $permission) {
            $permission->label('Role Show')
                    ->routes('admin.role.show');
        });

        $group = PermissionFacade::add('configuration', function (PermissionGroup $group) {
            $group->label('Configuration Permissions');
        });

        $group->addPermission('admin-configuration', function (Permission $permission) {
            $permission->label('Configuration')
                    ->routes('admin.configuration');
        });
        $group->addPermission('admin-configuration-store', function (Permission $permission) {
            $permission->label('Configuration Store')
                    ->routes('admin.configuration.store');
        });

        $group = PermissionFacade::add('site-currency', function (PermissionGroup $group) {
            $group->label('Site Currency Permissions');
        });

        $group->addPermission('admin-site-currency-list', function (Permission $permission) {
            $permission->label('Site Currency List')
                    ->routes('admin.site-currency.index');
        });
        $group->addPermission('admin-site-currency-create', function (Permission $permission) {
            $permission->label('Site Currency Create')
                    ->routes('admin.site-currency.create,admin.site-currency.store');
        });
        $group->addPermission('admin-site-currency-update', function (Permission $permission) {
            $permission->label('Site Currency Update')
                    ->routes('admin.site-currency.edit,admin.site-currency.update');
        });
        $group->addPermission('admin-site-currency-destroy', function (Permission $permission) {
            $permission->label('Site Currency Destroy')
                    ->routes('admin.site-currency.destroy');
        });
        $group->addPermission('admin-site-currency-show', function (Permission $permission) {
            $permission->label('Site Currency Show')
                    ->routes('admin.site-currency.show');
        });

        $group = PermissionFacade::add('country', function (PermissionGroup $group) {
            $group->label('Country Permissions');
        });

        $group->addPermission('admin-country-list', function (Permission $permission) {
            $permission->label('Country  List')
                    ->routes('admin.country.index');
        });
        $group->addPermission('admin-country-create', function (Permission $permission) {
            $permission->label('Country Create')
                    ->routes('admin.country.create,admin.country.store');
        });
        $group->addPermission('admin-country-update', function (Permission $permission) {
            $permission->label('Country Update')
                    ->routes('admin.country.edit,admin.country.update');
        });
        $group->addPermission('admin-country-destroy', function (Permission $permission) {
            $permission->label('Country Destroy')
                    ->routes('admin.country.destroy');
        });
        $group->addPermission('admin-country-show', function (Permission $permission) {
            $permission->label('Country Show')
                    ->routes('admin.country.show');
        });

        $group = PermissionFacade::add('state', function (PermissionGroup $group) {
            $group->label('State Permissions');
        });

        $group->addPermission('admin-state-list', function (Permission $permission) {
            $permission->label('State List')
                    ->routes('admin.state.index');
        });
        $group->addPermission('admin-state-create', function (Permission $permission) {
            $permission->label('State Create')
                    ->routes('admin.state.create,admin.state.store');
        });
        $group->addPermission('admin-state-update', function (Permission $permission) {
            $permission->label('State Update')
                    ->routes('admin.state.edit,admin.state.update');
        });
        $group->addPermission('admin-site-currency-destroy', function (Permission $permission) {
            $permission->label('State Destroy')
                    ->routes('admin.state.destroy');
        });
        $group->addPermission('admin-site-currency-show', function (Permission $permission) {
            $permission->label('State Show')
                    ->routes('admin.state.show');
        });

        $group = PermissionFacade::add('theme', function (PermissionGroup $group) {
            $group->label('Theme Permissions');
        });

        $group->addPermission('admin-theme-list', function (Permission $permission) {
            $permission->label('Theme List')
                    ->routes('admin.theme.index');
        });
        $group->addPermission('admin-theme-create', function (Permission $permission) {
            $permission->label('Theme Upload/Create')
                    ->routes('admin.create.index', 'admin.theme.store');
        });
        $group->addPermission('admin-theme-activated', function (Permission $permission) {
            $permission->label('Theme Activated')
                    ->routes('admin.activated.index');
        });
        $group->addPermission('admin-theme-deactivated', function (Permission $permission) {
            $permission->label('Theme Deactivated')
                    ->routes('admin.deactivated.index');
        });
        //$group->addPermission('admin-theme-destroy', function(Permission $permission) {
        //    $permission->label('Theme Destroy')
        //            ->routes('admin.destroy.index');
        //});

        $group = PermissionFacade::add('module', function (PermissionGroup $group) {
            $group->label('Module Permissions');
        });

        $group->addPermission('admin-module-list', function (Permission $permission) {
            $permission->label('Module List')
                    ->routes('admin.module.index');
        });
        $group->addPermission('admin-module-create', function (Permission $permission) {
            $permission->label('Module Upload')
                    ->routes('admin.create.index', 'admin.module.store');
        });

        Blade::if('hasPermission', function ($routeName) {
            $condition = false;
            $user = Auth::guard('admin')->user();

            if (!$user) {
                $condition = $user->hasPermission($routeName) ?: false;
            }

            $converted_res = ($condition) ? 'true' : 'false';

            return "<?php if ($converted_res): ?>";
        });
    }
}
