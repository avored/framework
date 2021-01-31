<?php

namespace AvoRed\Framework\Menu;

use AvoRed\Framework\Menu\MenuItem;
use AvoRed\Framework\Menu\MenuBuilder;
use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Menu;

class MenuProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the Service Provider.
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
        $this->app->alias('menu', MenuBuilder::class);
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
        return ['menu', MenuBuilder::class];
    }

    /**
     * Register Admin Menu for the AvoRed E commerce package.
     * @return void
     */
    public function registerAdminMenu()
    {
        Menu::make('catalog', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.catalog')
                ->type(MenuItem::ADMIN)
                ->icon('store-front')
                ->route('#');
        });

        $catalogMenu = Menu::get('catalog');

        /** @var Builder $catalogMenu */
        $catalogMenu->subMenu('product', function (MenuItem $menu) {
            $menu->key('product')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.product')
                ->route('admin.product.index');
        });
        $catalogMenu->subMenu('category', function (MenuItem $menu) {
            $menu->key('category')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.category')
                ->route('admin.category.index');
        });
        $catalogMenu->subMenu('property', function (MenuItem $menu) {
            $menu->key('property')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.property')
                ->route('admin.property.index');
        });

        $catalogMenu->subMenu('attribute', function (MenuItem $menu) {
            $menu->key('attribute')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.attribute')
                ->route('admin.attribute.index');
        });

        Menu::make('cms', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.cms')
                ->type(MenuItem::ADMIN)
                ->icon('news-paper')
                ->route('#');
        });
        $cmsMenu = Menu::get('cms');
        /** @var Builder $cmsMenu */
        $cmsMenu->subMenu('menu-group', function (MenuItem $menu) {
            $menu->key('menu-group')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.menu')
                ->route('admin.menu-group.index');
        });
        $cmsMenu->subMenu('page', function (MenuItem $menu) {
            $menu->key('page')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.page')
                ->route('admin.page.index');
        });
        Menu::make('order', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.order')
                ->icon('wallet')
                ->type(MenuItem::ADMIN)
                ->route('#');
        });

        $orderMenu = Menu::get('order');
        /** @var Builder $orderMenu */
        $orderMenu->subMenu('order', function (MenuItem $menu) {
            $menu->key('order')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.order')
                ->route('admin.order.index');
        });
        $orderMenu->subMenu('order-status', function (MenuItem $menu) {
            $menu->key('order-status')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.order-status')
                ->route('admin.order-status.index');
        });

        Menu::make('report', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.report')
                ->type(MenuItem::ADMIN)
                ->icon('book-reference')
                ->route('#');
        });
        $reportMenu = Menu::get('report');
        $reportMenu->subMenu('new_customer', function (MenuItem $menu) {
            $menu->key('new_customer')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.new_customer')
                ->route('admin.report.index')
                ->params(['identifier' => 'new-customer']);
        });
        
        Menu::make('user', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.user')
                ->type(MenuItem::ADMIN)
                ->icon('user-group')
                ->route('#');
        });

        Menu::make('promotion', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.promotion')
                ->icon('ticket')
                ->type(MenuItem::ADMIN)
                ->route('#');
        });
        $promotionMenu = Menu::get('promotion');
        /** @var Builder $promotionMenu */
        $promotionMenu->subMenu('promotion_code', function (MenuItem $menu) {
            $menu->key('promotion_code')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.promo-code')
                ->route('admin.promotion-code.index');
        });

        $userMenu = Menu::get('user');
        /** @var Builder $userMenu */

        // $userMenu->subMenu('customer', function (MenuItem $menu) {
        //     $menu->key('customer')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.admin_menus.customer')
        //         ->route('admin.customer.index');
        // });
        $userMenu->subMenu('customer_group', function (MenuItem $menu) {
            $menu->key('customer_group')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.customer-group')
                ->route('admin.customer-group.index');
        });

        $userMenu->subMenu('admin-user', function (MenuItem $menu) {
            $menu->key('admin-user')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.admin-user')
                ->route('admin.admin-user.index');
        });
        
        Menu::make('system', function (MenuItem $menu) {
            $menu->label('avored::system.admin_menus.system')
                ->type(MenuItem::ADMIN)
                ->icon('cog')
                ->route('#');
        });

        $systemMenu = Menu::get('system');
        /** @var Builder $systemMenu */
        $systemMenu->subMenu('configuration', function (MenuItem $menu) {
            $menu->key('configuration')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.configuration')
                ->route('admin.configuration.index');
        });

        $systemMenu->subMenu('currency', function (MenuItem $menu) {
            $menu->key('currency')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.currency')
                ->route('admin.currency.index');
        });

        // $systemMenu->subMenu('state', function (MenuItem $menu) {
        //     $menu->key('state')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.admin_menus.state')
        //         ->route('admin.state.index');
        // });

        $systemMenu->subMenu('role', function (MenuItem $menu) {
            $menu->key('role')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.admin_menus.role')
                ->route('admin.role.index');
        });
        // $systemMenu->subMenu('language', function (MenuItem $menu) {
        //     $menu->key('language')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.admin_menus.language')
        //         ->route('admin.language.index');
        // });
    }
}
