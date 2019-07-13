<?php

namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Tab\Manager;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Tab\TabItem;

class TabProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerTabs();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->singleton('tab', 'AvoRed\Framework\Tab\Manager');
    }

    /**
     * Register the tab Manager Instance.
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton(
            'tab',
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
        return ['tab','AvoRed\Framework\Tab\Manager'];
    }

    /**
     * Register Tabs for the Different CRUD operations
     * @return void
     */
    public function registerTabs()
    {
        Tab::put('catalog.product', function (TabItem $tab) {
            $tab->key('catalog.product.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::catalog.product._fields');
        });
        Tab::put('catalog.product', function (TabItem $tab) {
            $tab->key('catalog.product.image')
                ->label('avored::system.tab.images')
                ->view('avored::catalog.product.cards.images');
        });
        Tab::put('catalog.product', function (TabItem $tab) {
            $tab->key('catalog.product.property')
                ->label('avored::system.tab.property')
                ->view('avored::catalog.product.cards.property');
        });
        Tab::put('catalog.product', function (TabItem $tab) {
            $tab->key('catalog.product.attribute')
                ->label('avored::system.tab.attribute')
                ->view('avored::catalog.product.cards.attribute');
        });

        Tab::put('system.configuration', function (TabItem $tab) {
            $tab->key('system.configuration.basic')
                ->label('avored::system.tab.basic_configuration')
                ->view('avored::system.configuration.cards.basic');
        });
        Tab::put('system.configuration', function (TabItem $tab) {
            $tab->key('system.configuration.user')
                ->label('avored::system.tab.user_configuration')
                ->view('avored::system.configuration.cards.user');
        });
        Tab::put('system.configuration', function (TabItem $tab) {
            $tab->key('system.configuration.shipping')
                ->label('avored::system.tab.shipping_configuration')
                ->view('avored::system.configuration.cards.shipping');
        });
        Tab::put('system.configuration', function (TabItem $tab) {
            $tab->key('system.configuration.payment')
                ->label('avored::system.tab.payment_configuration')
                ->view('avored::system.configuration.cards.payment');
        });
    }
}
