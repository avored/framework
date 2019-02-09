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
        $group = PermissionFacade::add(
            'page',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.page.title');
            }
        );
        $group->addPermission(
            'admin-page-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.page.list')
                    ->routes('admin.page.index');
            }
        );
        $group->addPermission(
            'admin-page-create', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.page.create')
                    ->routes('admin.page.create,admin.page.store');
            }
        );
        $group->addPermission(
            'admin-page-update', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.page.edit')
                    ->routes('admin.page.edit,admin.page.update');
            }
        );
        $group->addPermission(
            'admin-page-destroy', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.page.destroy')
                    ->routes('admin.page.destroy');
            }
        );
        $group->addPermission(
            'admin-page-show', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.page.show')
                    ->routes('admin.page.show');
            }
        );

        $group = PermissionFacade::add(
            'menu', 
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.menu.title');
            }
        );

        $group->addPermission(
            'admin-menu-list', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.menu.front')
                    ->routes('admin.menu.index');
            }
        );

        $group->addPermission(
            'admin-menu-store', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.menu.save')
                    ->routes('admin.menu.store');
            }
        );

        $group = PermissionFacade::add(
            'category', 
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.category.title');
            }
        );
        $group->addPermission(
            'admin-category-list', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.category.list')
                    ->routes('admin.category.index');
            }
        );
        $group->addPermission(
            'admin-category-create', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.category.create')
                    ->routes('admin.category.create,admin.category.store');
            }
        );
        $group->addPermission(
            'admin-category-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.category.edit')
                    ->routes('admin.category.edit,admin.category.update');
            }
        );
        $group->addPermission(
            'admin-category-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.category.destroy')
                    ->routes('admin.category.destroy');
            }
        );
        $group->addPermission(
            'admin-category-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.category.show')
                    ->routes('admin.category.show');
            }
        );

        $group = PermissionFacade::add(
            'product',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.product.title');
            }
        );

        $group->addPermission(
            'admin-product-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.product.list')
                    ->routes('admin.product.index');
            }
        );
        $group->addPermission(
            'admin-product-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.product.create')
                    ->routes('admin.product.create,admin.product.store');
            }
        );
        $group->addPermission(
            'admin-product-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.product.edit')
                    ->routes('admin.product.edit,admin.product.update');
            }
        );
        $group->addPermission(
            'admin-product-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.product.destroy')
                    ->routes('admin.product.destroy');
            }
        );
        $group->addPermission(
            'admin-product-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.product.show')
                    ->routes('admin.product.show');
            }
        );

        $group = PermissionFacade::add(
            'order',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.order.title');
            }
        );

        $group->addPermission(
            'admin-order-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.order.list')
                    ->routes('admin.order.index');
            }
        );

        $group->addPermission(
            'admin-order-view',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.order.view')
                    ->routes('admin.order.view');
            }
        );
        $group->addPermission(
            'admin-order-send-invoice-email',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.order.sent_invoice_by_mail')
                    ->routes('admin.order.send-email-invoice');
            }
        );
        $group->addPermission(
            'admin-order-change-status', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.order.status_change')
                    ->routes('admin.order.change-status,admin.order.update-status');
            }
        );

        $group = PermissionFacade::add(
            'order-status',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.order_status.title');
            }
        );
        $group->addPermission(
            'admin-order-status-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.order_status.list')
                    ->routes('admin.order-status.index');
            }
        );
        $group->addPermission(
            'admin-order-status-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.order_status.create')
                    ->routes('admin.order-status.create,admin.order-status.store');
            }
        );
        $group->addPermission(
            'admin-order-status-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.order_status.edit')
                    ->routes('admin.order-status.edit,admin.order-status.update');
            }
        );
        $group->addPermission(
            'admin-order-status-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.order_status.destroy')
                    ->routes('admin.order-status.destroy');
            }
        );
        $group->addPermission(
            'admin-order-status-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.order_status.show')
                    ->routes('admin.order-status.show');
            }
        );

        $group = PermissionFacade::add(
            'attribute',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.attribute.title');
            }
        );
        $group->addPermission(
            'admin-attribute-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.attribute.list')
                    ->routes('admin.attribute.index');
            }
        );
        $group->addPermission(
            'admin-attribute-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.attribute.create')
                    ->routes('admin.attribute.create,admin.attribute.store');
            }
        );
        $group->addPermission(
            'admin-attribute-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.attribute.edit')
                    ->routes('admin.attribute.edit,admin.attribute.update');
            }
        );
        $group->addPermission(
            'admin-attribute-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.attribute.destroy')
                    ->routes('admin.attribute.destroy');
            }
        );
        $group->addPermission(
            'admin-attribute-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.attribute.show')
                    ->routes('admin.attribute.show');
            }
        );

        $group = PermissionFacade::add(
            'property',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.property.title');
            }
        );

        $group->addPermission(
            'admin-property-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.property.list')
                    ->routes('admin.property.index');
            }
        );
        $group->addPermission(
            'admin-property-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.property.create')
                    ->routes('admin.property.create,admin.property.store');
            }
        );
        $group->addPermission(
            'admin-attribute-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.property.edit')
                    ->routes('admin.property.edit,admin.property.update');
            }
        );
        $group->addPermission(
            'admin-property-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.property.destroy')
                    ->routes('admin.property.destroy');
            }
        );
        $group->addPermission(
            'admin-property-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.property.show')
                    ->routes('admin.property.show');
            }
        );

        $group = PermissionFacade::add(
            'user',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.user.title');
            }
        );

        $group->addPermission(
            'admin-user-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user.list')
                    ->routes('admin.user.index');
            }
        );
        $group->addPermission(
            'admin-user-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user.create')
                    ->routes('admin.user.create,admin.user.store');
            }
        );
        $group->addPermission(
            'admin-user-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user.edit')
                    ->routes('admin.user.edit,admin.user.update');
            }
        );
        $group->addPermission(
            'admin-user-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user.destroy')
                    ->routes('admin.user.destroy');
            }
        );
        $group->addPermission(
            'admin-user-show', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user.show')
                    ->routes('admin.user.show');
            }
        );

        $group = PermissionFacade::add(
            'user-group',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.user_group.title');
            }
        );

        $group->addPermission(
            'admin-user-group-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user_group.list')
                    ->routes('admin.user-group.index');
            }
        );
        $group->addPermission(
            'admin-user-group-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user_group.create')
                    ->routes('admin.user-group.create,admin.user-group.store');
            }
        );
        $group->addPermission(
            'admin-user-group.update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user_group.edit')
                    ->routes('admin.user-group.edit,admin.user-group.update');
            }
        );
        $group->addPermission(
            'admin-user-group-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user_group.destroy')
                    ->routes('admin.user-group.destroy');
            }
        );
        $group->addPermission(
            'admin-user-group-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.user_group.show')
                    ->routes('admin.user-group.show');
            }
        );

        $group = PermissionFacade::add(
            'admin-user',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.admin_user.title');
            }
        );

        $group->addPermission(
            'admin-admin-user-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.admin_user.list')
                    ->routes('admin.admin-user.index');
            }
        );
        $group->addPermission(
            'admin-admin-user-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.admin_user.create')
                    ->routes('admin.admin-user.create,admin.admin-user.store');
            }
        );
        $group->addPermission(
            'admin-admin-user-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.admin_user.edit')
                    ->routes('admin.admin-user.edit,admin.admin-user.update');
            }
        );
        $group->addPermission(
            'admin-admin-user-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.admin_user.destroy')
                    ->routes('admin.admin-user.destroy');
            }
        );
        $group->addPermission(
            'admin-admin-user-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.admin_user.show')
                    ->routes('admin.admin-user.show');
            }      
        );

        $group = PermissionFacade::add(
            'role',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.role.title');
            }
        );

        $group->addPermission(
            'admin-role-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.role.list')
                    ->routes('admin.role.index');
            }
        );
        $group->addPermission(
            'admin-role-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.role.create')
                    ->routes('admin.role.create,admin.role.store');
            }           
        );
        $group->addPermission(
            'admin-role-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.role.edit')
                    ->routes('admin.role.edit,admin.role.update');
            }
        );
        $group->addPermission(
            'admin-role-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.role.destroy')
                    ->routes('admin.role.destroy');
            }
        );
        $group->addPermission(
            'admin-role-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.role.show')
                    ->routes('admin.role.show');
            }
        );

        $group = PermissionFacade::add(
            'configuration',
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.configuration.title');
            }
        );

        $group->addPermission(
            'admin-configuration',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.configuration.view')
                    ->routes('admin.configuration');
            }
        );
        $group->addPermission(
            'admin-configuration-store',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.configuration.edit')
                    ->routes('admin.configuration.store');
            }    
        );

        $group = PermissionFacade::add(
            'site-currency',
            function (PermissionGroup $group) {
                $group->label('Site Currency Permissions');
            }
        );

        $group->addPermission(
            'admin-site-currency-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.site_currency.title')
                    ->routes('admin.site-currency.index');
            }
        );
        $group->addPermission(
            'admin-site-currency-create', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.site_currency.create')
                    ->routes('admin.site-currency.create,admin.site-currency.store');
            }
        );
        $group->addPermission(
            'admin-site-currency-update', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.site_currency.edit')
                    ->routes('admin.site-currency.edit,admin.site-currency.update');
            }
        );
        $group->addPermission(
            'admin-site-currency-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.site_currency.destroy')
                    ->routes('admin.site-currency.destroy');
            }
        );
        $group->addPermission(
            'admin-site-currency-show', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.site_currency.show')
                    ->routes('admin.site-currency.show');
            }
        );

        $group = PermissionFacade::add(
            'country', 
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.country.title');
            }
        );

        $group->addPermission(
            'admin-country-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.country.list')
                    ->routes('admin.country.index');
            }
        );
        $group->addPermission(
            'admin-country-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.country.create')
                    ->routes('admin.country.create,admin.country.store');
            }
        );
        $group->addPermission(
            'admin-country-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.country.edit')
                    ->routes('admin.country.edit,admin.country.update');
            }
        );
        $group->addPermission(
            'admin-country-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.country.destroy')
                    ->routes('admin.country.destroy');
            }
        );
        $group->addPermission(
            'admin-country-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.country.show')
                    ->routes('admin.country.show');
            }
        );
        $group = PermissionFacade::add(
            'language', 
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.language.title');
            }
        );

        $group->addPermission(
            'admin-language-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.language.list')
                    ->routes('admin.language.index');
            }
        );
        $group->addPermission(
            'admin-language-create',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.language.create')
                    ->routes('admin.language.create,admin.language.store');
            }
        );
        $group->addPermission(
            'admin-language-update',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.language.edit')
                    ->routes('admin.language.edit,admin.language.update');
            }
        );
        $group->addPermission(
            'admin-language-destroy',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.language.destroy')
                    ->routes('admin.language.destroy');
            }
        );
        $group->addPermission(
            'admin-language-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.language.show')
                    ->routes('admin.language.show');
            }
        );

        $group = PermissionFacade::add(
            'state', 
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.state.title');
            }
        );

        $group->addPermission(
            'admin-state-list', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.state.list')
                    ->routes('admin.state.index');
            }
        );
        $group->addPermission(
            'admin-state-create', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.state.create')
                    ->routes('admin.state.create,admin.state.store');
            }
        );
        $group->addPermission(
            'admin-state-update', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.state.edit')
                    ->routes('admin.state.edit,admin.state.update');
            }
        );
        $group->addPermission(
            'admin-site-currency-destroy', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.state.destroy')
                    ->routes('admin.state.destroy');
            }
        );
        $group->addPermission(
            'admin-site-currency-show',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.state.show')
                    ->routes('admin.state.show');
            }
        );

        $group = PermissionFacade::add(
            'theme', 
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.theme.title');
            }
        );

        $group->addPermission(
            'admin-theme-list',
            function (Permission $permission) {
                $permission->label('avored-framework::permission.theme.list')
                    ->routes('admin.theme.index');
            }
        );
        $group->addPermission(
            'admin-theme-create', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.theme.create')
                    ->routes('admin.create.index', 'admin.theme.store');
            }
        );
        $group->addPermission(
            'admin-theme-activated', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.theme.activated')
                    ->routes('admin.activated.index');
            }
        );
        $group->addPermission(
            'admin-theme-deactivated', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.theme.deactivated')
                    ->routes('admin.deactivated.index');
            }
        );

        $group = PermissionFacade::add(
            'module', 
            function (PermissionGroup $group) {
                $group->label('avored-framework::permission.module.title');
            }
        );

        $group->addPermission(
            'admin-module-list', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.module.list')
                    ->routes('admin.module.index');
            }
        );
        $group->addPermission(
            'admin-module-create', 
            function (Permission $permission) {
                $permission->label('avored-framework::permission.module.upload')
                    ->routes('admin.create.index', 'admin.module.store');
            }
        );

        Blade::if(
            'hasPermission', 
            function ($routeName) {
                $condition = false;
                $user = Auth::guard('admin')->user();
                if (!$user) {
                    $condition = $user->hasPermission($routeName) ?: false;
                }
                $converted_res = ($condition) ? 'true' : 'false';
                return "<?php if ($converted_res): ?>";
            }
        );
    }
}
