<?php

namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\Tab\Manager;
use AvoRed\Framework\Tab\TabItem;
use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Tab;

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
        return ['tab', 'AvoRed\Framework\Tab\Manager'];
    }

    /**
     * Register Tabs for the Different CRUD operations.
     * @return void
     */
    public function registerTabs()
    {

        Tab::put('promotion.promotion-code', function (TabItem $tab) {
            $tab->key('promotion.promotion-code.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::promotion.promotion-code._fields');
        });

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

        /****** CATALOG CATEGORY TABS *******/
        Tab::put('catalog.category', function (TabItem $tab) {
            $tab->key('catalog.category.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::catalog.category._fields');
        });

        /****** CATALOG PROPERTY TABS *******/
        Tab::put('catalog.property', function (TabItem $tab) {
            $tab->key('catalog.property.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::catalog.property._fields');
        });

        /****** CATALOG ATTRIBUTE TABS *******/
        Tab::put('catalog.attribute', function (TabItem $tab) {
            $tab->key('catalog.attribute.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::catalog.attribute._fields');
        });

        /******CMS PAGES TABS  *******/
        Tab::put('cms.page', function (TabItem $tab) {
            $tab->key('cms.page.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::cms.page._fields');
        });

        /******ORDER ORDER STATUS TABS  *******/
        Tab::put('order.order-status', function (TabItem $tab) {
            $tab->key('order.order-status.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::order.order-status._fields');
        });

        /****** CUSTOMER GROUPS TABS  *******/
        Tab::put('user.customer-group', function (TabItem $tab) {
            $tab->key('user.customer-group.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::user.customer-group._fields');
        });

        Tab::put('user.customer', function (TabItem $tab) {
            $tab->key('user.customer.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::user.customer._fields');
        });

        Tab::put('user.customer', function (TabItem $tab) {
            $tab->key('user.customer.address')
                ->label('avored::system.addresses')
                ->view('avored::user.customer._addresses');
        });

        Tab::put('user.address', function (TabItem $tab) {
            $tab->key('user.customer.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::user.customer.show');
        });
        Tab::put('user.address', function (TabItem $tab) {
            $tab->key('user.customer.address')
                ->label('avored::system.addresses')
                ->view('avored::user.address._fields');
        });

        /******USER ADMIN USER TABS  *******/
        Tab::put('user.admin-user', function (TabItem $tab) {
            $tab->key('user.admin-user.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::user.admin-user._fields');
        });

        /******SYSTEM CURRENCY TABS  *******/
        Tab::put('system.currency', function (TabItem $tab) {
            $tab->key('system.currency.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::system.currency._fields');
        });

        /******SYSTEM STATE TABS  *******/
        Tab::put('system.state', function (TabItem $tab) {
            $tab->key('system.state.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::system.state._fields');
        });

        /******SYSTEM ROLE TABS  *******/
        Tab::put('system.role', function (TabItem $tab) {
            $tab->key('system.role.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::system.role._fields');
        });

        /******SYSTEM ROLE TABS  *******/
        Tab::put('system.language', function (TabItem $tab) {
            $tab->key('system.language.info')
                ->label('avored::system.tab.basic_info')
                ->view('avored::system.language._fields');
        });

        /******SYSTEM CONFIGURATION TABS  *******/
        Tab::put('system.configuration', function (TabItem $tab) {
            $tab->key('system.configuration.basic')
                ->label('avored::system.tab.basic_configuration')
                ->view('avored::system.configuration.cards.basic');
        });

        // Tab::put('system.configuration', function (TabItem $tab) {
        //     $tab->key('system.configuration.user')
        //         ->label('avored::system.tab.user_configuration')
        //         ->view('avored::system.configuration.cards.user');
        // });
        Tab::put('system.configuration', function (TabItem $tab) {
            $tab->key('system.configuration.tax')
                ->label('avored::system.tab.tax_configuration')
                ->view('avored::system.configuration.cards.tax');
        });

        // Tab::put('system.configuration', function (TabItem $tab) {
        //     $tab->key('system.configuration.shipping')
        //         ->label('avored::system.tab.shipping_configuration')
        //         ->view('avored::system.configuration.cards.shipping');
        // });
        // Tab::put('system.configuration', function (TabItem $tab) {
        //     $tab->key('system.configuration.payment')
        //         ->label('avored::system.tab.payment_configuration')
        //         ->view('avored::system.configuration.cards.payment');
        // });
    }
}
