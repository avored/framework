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
                ->label('Basic Info')
                ->view('avored::catalog.product._fields');
        });
        Tab::put('catalog.product', function (TabItem $tab) {
            $tab->key('catalog.product.image')
                ->label('Images')
                ->view('avored::catalog.product.cards.images');
        });
        Tab::put('catalog.product', function (TabItem $tab) {
            $tab->key('catalog.product.property')
                ->label('Property')
                ->view('avored::catalog.product.cards.property');
        });
    }
}
