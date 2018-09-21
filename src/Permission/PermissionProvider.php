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
        $this->app->singleton('permission', function () {
            new Manager();
        });
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
        $group = PermissionFacade::add('page', function(PermissionGroup $group){
            $group->label('Page Permissions');
        });
        $group->addPermission('admin-page-list', function(Permission $permission){
            $permission->label('Page List')
                    ->routes('admin.page.index');
        });      
        $group->addPermission('admin-page-create', function(Permission $permission){
            $permission->label('Create Page')
                    ->routes('admin.page.create,admin.page.store');
        });
        $group->addPermission('admin-page-update', function(Permission $permission){
            $permission->label('Update Page')
                    ->routes('admin.page.edit,admin.page.update');
        });
        $group->addPermission('admin-page-destroy', function(Permission $permission){
            $permission->label('Destroy Page')
                    ->routes('admin.page.destroy');
        });
        $group->addPermission('admin-page-show', function(Permission $permission){
            $permission->label('Show Page')
                    ->routes('admin.page.show');
        });
    

        $group = PermissionFacade::add('menu', function(PermissionGroup $group){
            $group->label('Menu Permissions');
        });

        $group->addPermission('admin-menu-list')
                            ->label('Front Menu Index')
                            ->routes('admin.menu.index');

        $group->addPermission('admin-menu-store')
                            ->label('Save Front Menu')
                            ->routes('admin.menu.store');

        $group = PermissionFacade::add('category', function(PermissionGroup $group){
            $group->label('Category Permissions');
        });
        
        $group->addPermission('admin-category-list')
            ->label('Category List')
            ->routes('admin.category.index');

        $group->addPermission('admin-category-create')
            ->label('Create Category')
            ->routes('admin.category.create,admin.category.store');

        $group->addPermission('admin-category-update')
            ->label('Update Category')
            ->routes('admin.category.edit,admin.category.update');

        $group->addPermission('admin-category-destroy')
            ->label('Destroy Category')
            ->routes('admin.category.destroy');

        $group = PermissionFacade::add('product', function(PermissionGroup $group){
            $group->label('Product Permissions');
        });

        $group->addPermission('admin-product-list')
            ->label('Product List')
            ->routes('admin.product.index');
        $group->addPermission('admin-product-create')
            ->label('Create Product')
            ->routes('admin.product.create,admin.product.store');
        $group->addPermission('admin-product-update')
            ->label('Update Product')
            ->routes('admin.product.edit,admin.product.update');
        $group->addPermission('admin-product-destroy')
            ->label('Destroy Product')
            ->routes('admin.product.destroy');

        $group = PermissionFacade::add('order', function(PermissionGroup $group){
            $group->label('Order Permissions');
        });
        
        $group->addPermission('admin-order-list')
            ->label('Order List')
            ->routes('admin.order.index');
        $group->addPermission('admin-order-view')
            ->label('Order View')
            ->routes('admin.order.view');
        $group->addPermission('admin-order-send-invoice-email')
            ->label('Order Sent Invoice By Email')
            ->routes('admin.order.send-email-invoice');
        $group->addPermission('admin-order-change-status')
            ->label('Order Change Status')
            ->routes('admin.order.change-status,admin.order.update-status');

        $group = PermissionFacade::add('order-status', function(PermissionGroup $group){
            $group->label('Order Status Permissions');
        });
        $group->addPermission('admin-order-status-list')
            ->label('Order Status List')
            ->routes('admin.order-status.index');
        $group->addPermission('admin-order-status-create')
            ->label('Create Order Status')
            ->routes('admin.order-status.create,admin.order-status.store');
        $group->addPermission('admin-order-status-update')
            ->label('Update Order Status')
            ->routes('admin.order-status.edit,admin.order-status.update');
        $group->addPermission('admin-order-status-destroy')
            ->label('Destroy Order Status')
            ->routes('admin.order-status.destroy');

        $group = PermissionFacade::add('attribute', function(PermissionGroup $group){
            $group->label('Attribute Permissions');
        });
        $group->addPermission('admin-attribute-list')
            ->label('Attribute List')
            ->routes('admin.attribute.index');
        $group->addPermission('admin-attribute-create')
            ->label('Create Attribute')
            ->routes('admin.attribute.create,admin.attribute.store');
        $group->addPermission('admin-attribute-update')
            ->label('Edit Attribute')
            ->routes('admin.attribute.edit,admin.attribute.update');
        $group->addPermission('admin-attribute-destroy')
            ->label('Destroy Attribute')
            ->routes('admin.attribute.destroy');


        $group = PermissionFacade::add('property', function(PermissionGroup $group){
            $group->label('Property Permissions');
        });

        $group->addPermission('admin-property-list')
            ->label('Property List')
            ->routes('admin.property.index');
        $group->addPermission('admin-property-create')
            ->label('Property Create')
            ->routes('admin.property.create,admin.property.store');
        $group->addPermission('admin-attribute-update')
            ->label('Property Update')
            ->routes('admin.property.edit,admin.property.update');
        $group->addPermission('admin-property-destroy')
            ->label('Property Destroy')
            ->routes('admin.property.destroy');

        $group = PermissionFacade::add('user', function(PermissionGroup $group){
            $group->label('User Permissions');
        });

        $group->addPermission('admin-user-list')
            ->label('User List')
            ->routes('admin.user.index');
        $group->addPermission('admin-user-create')
            ->label('User Create')
            ->routes('admin.user.create,admin.user.store');
        $group->addPermission('admin-user-update')
            ->label('User Update')
            ->routes('admin.user.edit,admin.user.update');
        $group->addPermission('admin-user-destroy')
            ->label('User Destroy')
            ->routes('admin.user.destroy');

        $group = PermissionFacade::add('user-group', function(PermissionGroup $group){
            $group->label('User Group Permissions');
        });

        $group->addPermission('admin-user-group-list')
            ->label('User Group List')
            ->routes('admin.user-group.index');
        $group->addPermission('admin-user-group-create')
            ->label('User Group Create')
            ->routes('admin.user-group.create,admin.user-group.store');
        $group->addPermission('admin-user-group.update')
            ->label('User Group Update')
            ->routes('admin.user-group.edit,admin.user-group.update');
        $group->addPermission('admin-user-group-destroy')
            ->label('User Group Destroy')
            ->routes('admin.user-group.destroy');

        $group = PermissionFacade::add('admin-user', function(PermissionGroup $group){
            $group->label('Admin User Permissions');
        });

        $group->addPermission('admin-admin-user-list')
            ->label('Admin User List')
            ->routes('admin.admin-user.index');
        $group->addPermission('admin-admin-user-create')
            ->label('Admin User Create')
            ->routes('admin.admin-user.create,admin.admin-user.store');
        $group->addPermission('admin-admin-user-update')
            ->label('Admin User Update')
            ->routes('admin.admin-user.edit,admin.admin-user.update');
        $group->addPermission('admin-admin-user-destroy')
            ->label('Admin User Destroy')
            ->routes('admin.admin-user.destroy');

        $group = PermissionFacade::add('role', function(PermissionGroup $group){
            $group->label('Role Permissions');
        });

        $group->addPermission('admin-role-list')
            ->label('Role List')
            ->routes('admin.role.index');
        $group->addPermission('admin-role-create')
            ->label('Role Create')
            ->routes('admin.role.create,admin.role.store');
        $group->addPermission('admin-role-update')
            ->label('Role Update')
            ->routes('admin.role.edit,admin.role.update');
        $group->addPermission('admin-role-destroy')
            ->label('Role Destroy')
            ->routes('admin.role.destroy');

        $group = PermissionFacade::add('configuration', function(PermissionGroup $group){
            $group->label('Configuration Permissions');
        });

        $group->addPermission('admin-configuration')
            ->label('Configuration')
            ->routes('admin.configuration');
        $group->addPermission('admin-configuration-store')
            ->label('Configuration Store')
            ->routes('admin.configuration.store');


        $group = PermissionFacade::add('site-currency', function(PermissionGroup $group){
            $group->label('Site Currency Permissions');
        });

        $group->addPermission('admin-site-currency-list')
            ->label('Site Currency List')
            ->routes('admin.site-currency.index');
        $group->addPermission('admin-site-currency-create')
            ->label('Site Currency Create')
            ->routes('admin.site-currency.create,admin.site-currency.store');
        $group->addPermission('admin-site-currency-update')
            ->label('Site Currency Update')
            ->routes('admin.site-currency.edit,admin.site-currency.update');
        $group->addPermission('admin-site-currency-destroy')
            ->label('Site Currency Destroy')
            ->routes('admin.site-currency.destroy');
        
        $group = PermissionFacade::add('country', function(PermissionGroup $group){
            $group->label('Country Permissions');
        });

        $group->addPermission('admin-country-list')
            ->label('Country  List')
            ->routes('admin.country.index');
        $group->addPermission('admin-country-create')
            ->label('Country Create')
            ->routes('admin.country.create,admin.country.store');
        $group->addPermission('admin-country-update')
            ->label('Country Update')
            ->routes('admin.country.edit,admin.country.update');
        $group->addPermission('admin-country-destroy')
            ->label('Country Destroy')
            ->routes('admin.country.destroy');
        
        $group = PermissionFacade::add('state', function(PermissionGroup $group){
            $group->label('State Permissions');
        });

        $group->addPermission('admin-state-list')
            ->label('State List')
            ->routes('admin.state.index');
        $group->addPermission('admin-state-create')
            ->label('State Create')
            ->routes('admin.state.create,admin.state.store');
        $group->addPermission('admin-state-update')
            ->label('State Update')
            ->routes('admin.state.edit,admin.state.update');
        $group->addPermission('admin-site-currency-destroy')
            ->label('State Destroy')
            ->routes('admin.state.destroy');
        

        $group = PermissionFacade::add('theme', function(PermissionGroup $group){
            $group->label('Theme Permissions');
        });

        $group->addPermission('admin-theme-list')
            ->label('Theme List')
            ->routes('admin.theme.index');
        $group->addPermission('admin-theme-create')
            ->label('Theme Upload/Create')
            ->routes('admin.create.index', 'admin.theme.store');
        $group->addPermission('admin-theme-activated')
            ->label('Theme Activated')
            ->routes('admin.activated.index');
        $group->addPermission('admin-theme-deactivated')
            ->label('Theme Deactivated')
            ->routes('admin.deactivated.index');
        $group->addPermission('admin-theme-destroy')
            ->label('Theme Destroy')
            ->routes('admin.destroy.index');

        $group = PermissionFacade::add('module', function(PermissionGroup $group){
            $group->label('Module Permissions');
        });

        $group->addPermission('admin-module-list')
            ->label('Module List')
            ->routes('admin.module.index');
        $group->addPermission('admin-module-create')
            ->label('Module Upload')
            ->routes('admin.create.index', 'admin.module.store');

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
