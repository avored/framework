<?php

namespace AvoRed\Framework\AdminMenu;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;

class AdminMenuProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerAdminMenu();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('adminmenu', 'AvoRed\Framework\AdminMenu\Builder');
    }

    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton(
            'adminmenu',
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
        return ['adminmenu', 'AvoRed\Framework\AdminMenu\Builder'];
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        AdminMenuFacade::add(
            'shop',
            function (AdminMenu $shopMenu) {
                $shopMenu
                    ->label('avored-framework::system.admin_menu.catalog')
                    ->route('#')
                    ->icon('ti-shopping-cart');
            }
        );

        $shopMenu = AdminMenuFacade::get('shop');
        $shopMenu->subMenu(
            'category',
            function (AdminMenu $menu) {
                $menu->key('category')
                    ->label('avored-framework::system.admin_menu.categories')
                    ->route('admin.category.index');
            }
        );

        $shopMenu->subMenu(
            'product',
            function (AdminMenu $menu) {
                $menu->key('category')
                    ->label('avored-framework::system.admin_menu.products')
                    ->route('admin.product.index');
            }
        );

        $shopMenu->subMenu(
            'attribute',
            function (AdminMenu $menu) {
                $menu->key('attribute')
                    ->label('avored-framework::system.admin_menu.products_attributes')
                    ->route('admin.attribute.index');
            }
        );

        $shopMenu->subMenu(
            'property',
            function (AdminMenu $menu) {
                $menu->key('property')
                    ->label('avored-framework::system.admin_menu.property')
                    ->route('admin.property.index');
            }
        );

        AdminMenuFacade::add(
            'content', 
            function (AdminMenu $menu) {
                $menu->label('avored-framework::system.admin_menu.content')
                    ->route('#')
                    ->icon('ti-files');
            }
        );

        $contentMenu = AdminMenuFacade::get('content');
        $contentMenu->subMenu(
            'page',
            function (AdminMenu $menu) {
                $menu->key('page')
                    ->label('avored-framework::system.admin_menu.pages')
                    ->route('admin.page.index');
            }
        );

        $contentMenu->subMenu(
            'menu', 
            function (AdminMenu $menu) {
                $menu->key('menu')
                    ->label('avored-framework::system.admin_menu.menu')
                    ->route('admin.menu.index');
            }
        );

        AdminMenuFacade::add(
            'user',
            function (AdminMenu $menu) {
                $menu->label('avored-framework::system.admin_menu.customers')
                    ->route('#')
                    ->icon('ti-user');
            }
        );

        $userMenu = AdminMenuFacade::get('user');

        $userMenu->subMenu(
            'user',
            function (AdminMenu $menu) {
                $menu->key('user')
                    ->label('avored-framework::system.admin_menu.overview')
                    ->route('admin.user.index');
            }
        );
        $userMenu->subMenu(
            'user_group', 
            function (AdminMenu $menu) {
                $menu->key('user_group')
                    ->label('avored-framework::system.admin_menu.customers_groups')
                    ->route('admin.user-group.index');
            }
        );

        $userMenu->subMenu(
            'user_delete_request',
            function (AdminMenu $menu) {
                $menu->key('user_delete_request')
                    ->label('avored-framework::system.admin_menu.user_delete_request')
                    ->route('admin.user-delete-request.index')
                    ->icon('ti-users');
            }
        );

        AdminMenuFacade::add(
            'orders',
            function (AdminMenu $menu) {
                $menu->label('avored-framework::system.admin_menu.orders')
                    ->route('#')
                    ->icon('ti-truck');
            }
        );

        $orderMenu = AdminMenuFacade::get('orders');
        $orderMenu->subMenu(
            'order',
            function (AdminMenu $menu) {
                $menu->key('order')
                    ->label('avored-framework::system.admin_menu.overview')
                    ->route('admin.order.index');
            }
        );
        $orderMenu->subMenu(
            'order_return_request',
            function (AdminMenu $menu) {
                $menu->key('order_return_request')
                    ->label('avored-framework::system.admin_menu.order_return_request')
                    ->route('admin.order-return-request.index');
            }
        );

        $orderMenu->subMenu(
            'order_status', function (AdminMenu $menu) {
                $menu->key('order')
                    ->label('avored-framework::system.admin_menu.order_status')
                    ->route('admin.order-status.index');
            }
        );

        AdminMenuFacade::add(
            'system',
            function (AdminMenu $systemMenu) {
                $systemMenu->label('avored-framework::system.admin_menu.settings')
                    ->route('#')
                    ->icon('ti-settings');
            }
        );

        $systemMenu = AdminMenuFacade::get('system');
        $systemMenu->subMenu(
            'configuration',
            function (AdminMenu $menu) {
                $menu->key('configuration')
                    ->label('avored-framework::system.admin_menu.configuration')
                    ->route('admin.configuration')
                    ->icon('ti-settings');
            }
        );

        $systemMenu->subMenu(
            'language',
            function (AdminMenu $menu) {
                $menu->key('language')
                    ->label('avored-framework::system.admin_menu.language')
                    ->route('admin.language.index')
                    ->icon('ti-settings');
            }
        );

        $systemMenu->subMenu(
            'site_currency_setup',
            function (AdminMenu $menu) {
                $menu->key('site_currency_setup')
                    ->label('avored-framework::system.admin_menu.currencies')
                    ->route('admin.site-currency.index');
            }
        );

        $systemMenu->subMenu(
            'country',
            function (AdminMenu $menu) {
                $menu->key('country')
                    ->label('avored-framework::system.admin_menu.country')
                    ->route('admin.country.index');
            }
        );

        $systemMenu->subMenu(
            'state',
            function (AdminMenu $menu) {
                $menu->key('state')
                    ->label('avored-framework::system.admin_menu.state')
                    ->route('admin.state.index');
            }
        );
        $systemMenu->subMenu(
            'tax_group',
            function (AdminMenu $menu) {
                $menu->key('tax_group')
                    ->label('avored-framework::system.admin_menu.tax_group')
                    ->route('admin.tax-group.index');
            }
        );
        $systemMenu->subMenu(
            'tax_rate',
            function (AdminMenu $menu) {
                $menu->key('tax_rate')
                    ->label('avored-framework::system.admin_menu.tax_rate')
                    ->route('admin.tax-rate.index');
            }
        );

        $systemMenu->subMenu(
            'module',
            function (AdminMenu $menu) {
                $menu->key('module')
                    ->label('avored-framework::system.admin_menu.modules')
                    ->route('admin.module.index');
            }
        );

        $systemMenu->subMenu(
            'admin-user',
            function (AdminMenu $menu) {
                $menu->key('admin-user')
                    ->label('avored-framework::system.admin_menu.staff')
                    ->route('admin.admin-user.index');
            }
        );

        $systemMenu->subMenu(
            'role',
            function (AdminMenu $menu) {
                $menu->key('role')
                    ->label('avored-framework::system.admin_menu.roles_permissions')
                    ->route('admin.role.index');
            }
        );

        $systemMenu->subMenu(
            'themes', 
            function (AdminMenu $menu) {
                $menu->key('themes')
                    ->label('avored-framework::system.admin_menu.themes')
                    ->route('admin.theme.index');
            }
        );
    }
}
