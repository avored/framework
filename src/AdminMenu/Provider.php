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
        /*
        AdminMenuFacade::add('shop', function (AdminMenu $shopMenu) {
            $shopMenu->label('Shop')
                    ->route('#')
                    ->icon('fas fa-cart-plus');
        });
        */
        
        $shopMenu = AdminMenuFacade::get('shop');

        $shopMenu->subMenu('category',   function(AdminMenu $categoryMenu) {
            $categoryMenu->key('category')
            ->label('Category')
            ->route('admin.category.index')
            ->icon('far fa-building');
        });
    }
}
