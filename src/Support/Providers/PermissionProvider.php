<?php

namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Permission as PermissionFacade;
use AvoRed\Framework\Permission\Permission;
use AvoRed\Framework\Permission\PermissionGroup;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Permission\Manager;

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
        return ['permission','AvoRed\Framework\Permission\Manager'];
    }

    /**
     * Register the permissions.
     * @return void
     */
    protected function registerPermissions()
    {
        $group = PermissionFacade::add(
            'dashboard',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.dashboard');
            }
        );
        $group->addPermission(
            'admin-dashboard',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.dashboard')
                    ->routes('admin.dashboard');
            }
        );

        $group = PermissionFacade::add(
            'category',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.category.title');
            }
        );
        $group->addPermission(
            'admin-category-list',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.category.list')
                    ->routes('admin.category.index');
            }
        );
        $group->addPermission(
            'admin-category-create',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.category.create')
                    ->routes('admin.category.create,admin.category.store');
            }
        );
        $group->addPermission(
            'admin-category-update',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.category.edit')
                    ->routes('admin.category.edit,admin.category.update');
            }
        );
        $group->addPermission(
            'admin-category-destroy',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.category.destroy')
                    ->routes('admin.category.destroy');
            }
        );

        $group = PermissionFacade::add(
            'language',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.language.title');
            }
        );
        $group->addPermission(
            'admin-language-list',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.language.list')
                    ->routes('admin.language.index');
            }
        );
        $group->addPermission(
            'admin-language-create',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.language.create')
                    ->routes('admin.language.create,admin.language.store');
            }
        );
        $group->addPermission(
            'admin-language-update',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.language.edit')
                    ->routes('admin.language.edit,admin.language.update');
            }
        );
        $group->addPermission(
            'admin-language-destroy',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.language.destroy')
                    ->routes('admin.language.destroy');
            }
        );

        $group = PermissionFacade::add(
            'page',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.page.title');
            }
        );
        $group->addPermission(
            'admin-page-list',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.page.list')
                    ->routes('admin.page.index');
            }
        );
        $group->addPermission(
            'admin-page-create',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.page.create')
                    ->routes('admin.page.create,admin.page.store');
            }
        );
        $group->addPermission(
            'admin-page-update',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.page.edit')
                    ->routes('admin.page.edit,admin.page.update');
            }
        );
        $group->addPermission(
            'admin-page-destroy',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.page.destroy')
                    ->routes('admin.page.destroy');
            }
        );

        $group = PermissionFacade::add(
            'role',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.role.title');
            }
        );

        $group->addPermission(
            'admin-role-list',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.role.list')
                    ->routes('admin.role.index');
            }
        );
        $group->addPermission(
            'admin-role-create',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.role.create')
                    ->routes('admin.role.create,admin.role.store');
            }
        );
        $group->addPermission(
            'admin-role-update',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.role.edit')
                    ->routes('admin.role.edit,admin.role.update');
            }
        );
        $group->addPermission(
            'admin-role-destroy',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.role.destroy')
                    ->routes('admin.role.destroy');
            }
        );

        $group = PermissionFacade::add(
            'state',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.state.title');
            }
        );

        $group->addPermission(
            'admin-state-list',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.state.list')
                    ->routes('admin.state.index');
            }
        );
        $group->addPermission(
            'admin-state-create',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.state.create')
                    ->routes('admin.state.create,admin.state.store');
            }
        );
        $group->addPermission(
            'admin-state-update',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.state.edit')
                    ->routes('admin.state.edit,admin.state.update');
            }
        );
        $group->addPermission(
            'admin-state-destroy',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.state.destroy')
                    ->routes('admin.state.destroy');
            }
        );

        $group = PermissionFacade::add(
            'property',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.property.title');
            }
        );

        $group->addPermission(
            'admin-property-list',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.property.list')
                    ->routes('admin.property.index');
            }
        );
        $group->addPermission(
            'admin-property-create',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.property.create')
                    ->routes('admin.property.create,admin.property.store');
            }
        );
        $group->addPermission(
            'admin-property-update',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.property.edit')
                    ->routes('admin.property.edit,admin.property.update');
            }
        );
        $group->addPermission(
            'admin-property-destroy',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.property.destroy')
                    ->routes('admin.property.destroy');
            }
        );

        $group = PermissionFacade::add(
            'attribute',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.attribute.title');
            }
        );

        $group->addPermission(
            'admin-attribute-list',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.attribute.list')
                    ->routes('admin.attribute.index');
            }
        );
        $group->addPermission(
            'admin-attribute-create',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.attribute.create')
                    ->routes('admin.attribute.create,admin.attribute.store');
            }
        );
        $group->addPermission(
            'admin-attribute-update',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.attribute.edit')
                    ->routes('admin.attribute.edit,admin.attribute.update');
            }
        );
        $group->addPermission(
            'admin-attribute-destroy',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.attribute.destroy')
                    ->routes('admin.attribute.destroy');
            }
        );
        $group = PermissionFacade::add(
            'user-group',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.user-group.title');
            }
        );

        $group->addPermission(
            'admin-user-group-list',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.user-group.list')
                    ->routes('admin.user-group.index');
            }
        );
        $group->addPermission(
            'admin-user-group-create',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.user-group.create')
                    ->routes('admin.user-group.create,admin.user-group.store');
            }
        );
        $group->addPermission(
            'admin-user-group-update',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.user-group.edit')
                    ->routes('admin.user-group.edit,admin.user-group.update');
            }
        );
        $group->addPermission(
            'admin-user-group-destroy',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.user-group.destroy')
                    ->routes('admin.user-group.destroy');
            }
        );
        $group = PermissionFacade::add(
            'tax-group',
            function (PermissionGroup $group) {
                $group->label('avored::system.permissions.tax-group.title');
            }
        );

        $group->addPermission(
            'admin-tax-group-list',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.tax-group.list')
                    ->routes('admin.tax-group.index');
            }
        );
        $group->addPermission(
            'admin-tax-group-create',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.tax-group.create')
                    ->routes('admin.tax-group.create,admin.tax-group.store');
            }
        );
        $group->addPermission(
            'admin-tax-group-update',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.tax-group.edit')
                    ->routes('admin.tax-group.edit,admin.tax-group.update');
            }
        );
        $group->addPermission(
            'admin-tax-group-destroy',
            function (Permission $permission) {
                $permission->label('avored::system.permissions.tax-group.destroy')
                    ->routes('admin.user-group.destroy');
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
