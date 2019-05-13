<?php

namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Menu\MenuBuilder;
use AvoRed\Framework\Menu\MenuItem;
use AvoRed\Framework\Support\Facades\Menu;

class MenuProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the Service Provider
     * @return void
     */
    public function boot()
    {
        $this->registerAdminMenu();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('menu', 'AvoRed\Framework\Menu\MenuBuilder');
    }

    /**
     * Register the Admin Menu instance.
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton(
            'menu',
            function () {
                return new MenuBuilder();
            }
        );
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return ['menu', 'AvoRed\Framework\Menu\MenuBuilder'];
    }

    /**
     * Register Admin Menu for the AvoRed E commerce package
     * @return void
     */
    public function registerAdminMenu()
    {
        Menu::admin()->make('catalog', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.catalog')
                ->icon('shop')
                ->route('#');
        });

        $catalogMenu = Menu::admin()->get('catalog');
        $catalogMenu->subMenu('category', function (MenuItem $menu) {
            $menu->key('category')
                ->label('avored::system.admin_menus.category')
                ->route('admin.category.index');
        });

        Menu::admin()->make('cms', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.cms')
                ->icon('solution')
                ->route('#');
        });
        $cmsMenu = Menu::admin()->get('cms');
        $cmsMenu->subMenu('page', function (MenuItem $menu) {
            $menu->key('page')
                ->label('avored::system.admin_menus.page')
                ->route('admin.page.index');
        });

        Menu::admin()->make('order', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.order')
                ->icon('gold')
                ->route('#');
        });
        $cmsMenu = Menu::admin()->get('order');
        $cmsMenu->subMenu('order-status', function (MenuItem $menu) {
            $menu->key('order-status')
                ->label('avored::system.admin_menus.order-status')
                ->route('admin.order-status.index');
        });

        Menu::admin()->make('system', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.system')
                ->icon('setting')
                ->route('#');
        });

        $systemMenu = Menu::admin()->get('system');
       
        $systemMenu->subMenu('configuration', function (MenuItem $menu) {
            $menu->key('configuration')
                ->label('avored::system.admin_menus.configuration')
                ->route('admin.configuration.index');
        });

        $systemMenu->subMenu('admin-user', function (MenuItem $menu) {
            $menu->key('admin-user')
                ->label('avored::system.admin_menus.admin-user')
                ->route('admin.admin-user.index');
        });

        $systemMenu->subMenu('role', function (MenuItem $menu) {
            $menu->key('role')
                ->label('avored::system.admin_menus.role')
                ->route('admin.role.index');
        });
        $systemMenu->subMenu('language', function (MenuItem $menu) {
            $menu->key('language')
                ->label('avored::system.admin_menus.language')
                ->route('admin.language.index');
        });
    }
}
