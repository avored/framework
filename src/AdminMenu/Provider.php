<?php

namespace AvoRed\Framework\AdminMenu;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;

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
        $this->app->singleton('adminmenu', function ($app) {
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
        return ['adminmenu', 'AvoRed\Framework\AdminMenu\Builder'];
    }


    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        AdminMenuFacade::add('dashboard', function (AdminMenu $shopMenu) {
            $shopMenu->label('Dashboard')->route('admin.dashboard')->icon('fas fa-home');
        });
        
        AdminMenuFacade::add('cms', function (AdminMenu $cmsMenu) {
            $cmsMenu->label('Content')->route('#')->icon('fas fa-folder');
        });
        
        $cmsMenu = AdminMenuFacade::get('cms');        
        $cmsMenu->subMenu('page', function(AdminMenu $menu) {
            $menu->key('page')->label('Pages')->route('admin.page.index')->icon('fas fa-file');
        });
        
        $cmsMenu->subMenu('menu', function(AdminMenu $menu) {
            $menu->key('menu')->label('Menu')->route('admin.menu.index')->icon('fas fa-leaf');
        });

        AdminMenuFacade::add('shop', function (AdminMenu $shopMenu) {
            $shopMenu->label('Shop')->route('#')->icon('fas fa-cart-plus');
        });
        
        $shopMenu = AdminMenuFacade::get('shop');
        $shopMenu->subMenu('category', function(AdminMenu $menu) {
            $menu->key('category') ->label('Categories')->route('admin.category.index')->icon('far fa-building');
        });

        $shopMenu->subMenu('product', function(AdminMenu $menu) {
            $menu->key('category')->label('Products')->route('admin.product.index')->icon('fab fa-dropbox');
        });

        $shopMenu->subMenu('order', function(AdminMenu $menu) {
            $menu->key('order')->label("Orders")->route('admin.order.index')->icon('fas fa-dollar-sign');
        });

        $shopMenu->subMenu('attribute', function(AdminMenu $menu) {
            $menu->key('attribute')->label('Products Attributes')->route('admin.attribute.index')->icon('fas fa-file-alt');
        });

        $shopMenu->subMenu('property',   function(AdminMenu $menu) {
            $menu->key('property')->label('Property')->route('admin.property.index')->icon('fas fa-file-powerpoint');
        });
        
        AdminMenuFacade::add('system', function (AdminMenu $systemMenu) {
            $systemMenu->label('System')->route('#')->icon('fas fa-cogs');
        });

        $systemMenu = AdminMenuFacade::get('system');

        $systemMenu->subMenu('configuration', function(AdminMenu $menu) {
            $menu->key('configuration')->label('Configuration')->route('admin.configuration')->icon('fas fa-cog');
        });

        $systemMenu->subMenu('site_currency_setup', function(AdminMenu $menu) {
            $menu->key('site_currency_setup')->label('Currencies')->route('admin.site-currency.index')->icon('fas fa-dollar-sign');
        });

        $systemMenu->subMenu('module', function(AdminMenu $menu) {
            $menu->key('module')->label('Modules')->route('admin.module.index')->icon('fas fa-adjust');
        });

        $systemMenu->subMenu('role', function(AdminMenu $menu) {
            $menu->key('role')->label('Roles')->route('admin.role.index')->icon('fab fa-periscope');
        });

        $systemMenu->subMenu('admin-user', function(AdminMenu $menu) {
            $menu->key('admin-user')->label('Users')->route('admin.admin-user.index')->icon('fas fa-users');
        });

        $systemMenu->subMenu('themes', function(AdminMenu $menu) {
            $menu->key('themes')->label('Themes')->route('admin.theme.index')->icon('fas fa-adjust');
        });
    }
}