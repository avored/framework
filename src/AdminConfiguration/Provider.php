<?php

namespace AvoRed\Framework\AdminConfiguration;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminConfiguration\Facade as AdminConfigurationFacade;
use AvoRed\Framework\Models\Repository\SiteCurrencyRepository;
use AvoRed\Framework\Models\Database\Page;
use AvoRed\Framework\Models\Database\Country;

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
        
    /**
     * Boot the Provider
     *
     * @return void
     */
    public function boot()
    {
        $this->registerAdminConfiguration();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->singleton(
            'adminconfiguration', 
            \AvoRed\Framework\AdminConfiguration\Manager::class
        );
    }

    /**
     * Register the permission Manager Instance.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton(
            'adminconfiguration', 
            function () {
                new Manager();
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
        return ['adminconfiguration', 'AvoRed\Framework\AdminConfiguration\Manager'];
    }

    /**
     * Register the Admin Configuration.
     *
     * @return void
     */
    protected function registerAdminConfiguration()
    {
        $configurationGroup = AdminConfigurationFacade::add('general')
            ->label('avored-framework::system.configuration.general_title');

        $configurationGroup->addConfiguration('general_site_title')
            ->label('avored-framework::system.configuration.default_site_title')
            ->type('text')
            ->name('general_site_title');

        $configurationGroup->addConfiguration('general_site_description')
            ->label('avored-framework::system.configuration.default_site_description')
            ->type('text')
            ->name('general_site_description');

        $siteCurrencyRepository = new SiteCurrencyRepository;
        $configurationGroup->addConfiguration('general_site_currency')
            ->label('avored-framework::system.configuration.default_site_currency')
            ->type('select')
            ->name('general_site_currency')
            ->options($siteCurrencyRepository);

        $configurationGroup->addConfiguration('general_administrator_email')
            ->label('avored-framework::system.configuration.administrator_email')
            ->type('text')
            ->name('general_administrator_email');

        $configurationGroup->addConfiguration('general_term_condition_page')
            ->label('avored-framework::system.configuration.term_condition_page')
            ->type('select')
            ->name('general_term_condition_page')
            ->options(
                function () {
                    $options = Page::all()->pluck('name', 'id');
                    return $options;
                }
            );

        $configurationGroup->addConfiguration('general_home_page')
            ->label('avored-framework::system.configuration.home_page')
            ->type('select')
            ->name('general_home_page')
            ->options(
                function () {
                    return Page::all()->pluck('name', 'id');
                }
            );

        $userGroup = AdminConfigurationFacade::add('users')
            ->label('avored-framework::system.configuration.user_title');

        $userGroup->addConfiguration('user_default_country')
            ->label('avored-framework::system.configuration.user_default_country')
            ->type('select')
            ->name('user_default_country')
            ->options(
                function () {
                    return Country::all()->pluck('name', 'id');
                }
            );

        $userGroup->addConfiguration('user_activation_required')
            ->label('avored-framework::system.configuration.user_activation_required')
            ->type('select')
            ->name('user_activation_required')
            ->options(
                function () {
                    return [0 => 'No', 1 => 'Yes'];
                }
            );

        $userGroup->addConfiguration('user_delete_request_days')
            ->label('avored-framework::system.configuration.user_delete_request_days')
            ->type('text')
            ->name('user_delete_request_days');

        $shippingGroup = AdminConfigurationFacade::add('shipping')
            ->label('avored-framework::system.configuration.shipping_title');

        $shippingGroup->addConfiguration('shipping_free_shipping_enabled')
            ->label('avored-framework::system.configuration.is_free_shipping_enabled')
            ->type('select')
            ->name('shipping_free_shipping_enabled')
            ->options(
                function () {
                    return [1 => 'Yes', 0 => 'No'];
                }
            );

        $paymentGroup = AdminConfigurationFacade::add('payment')
            ->label('avored-framework::system.configuration.payment_title');

        $paymentGroup->addConfiguration('payment_stripe_enabled')
            ->label('avored-framework::system.configuration.payment_stripe_enabled')
            ->type('select')
            ->name('payment_stripe_enabled')
            ->options(
                function () {
                    return [0 => 'No', 1 => 'Yes'];
                }
            );

        $paymentGroup->addConfiguration('payment_stripe_publishable_key')
            ->label('avored-framework::system.configuration.payment_stripe_publishable_key')
            ->type('text')
            ->name('payment_stripe_publishable_key');

        $paymentGroup->addConfiguration('avored_stripe_secret_key')
            ->label('avored-framework::system.configuration.payment_stripe_secret_key')
            ->type('text')
            ->name('avored_stripe_secret_key');

        $taxGroup = AdminConfigurationFacade::add('tax')
            ->label('avored-framework::system.configuration.tax_title');

        $taxGroup->addConfiguration('tax_enabled')
            ->label('avored-framework::system.configuration.is_tax_enabled')
            ->type('select')
            ->name('tax_enabled')
            ->options(
                function () {
                    return [1 => 'Yes', 0 => 'No'];
                }
            );

        $taxGroup->addConfiguration('tax_percentage')
            ->label('avored-framework::system.configuration.tax_percentage')
            ->type('text')
            ->name('tax_percentage');

        $taxGroup->addConfiguration('tax_default_country')
            ->label('avored-framework::system.configuration.tax_default_country')
            ->type('select')
            ->name('tax_default_country')
            ->options(
                function () {
                    return $options = Country::all()->pluck('name', 'id');
                }
            );
    }
}
