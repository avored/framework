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
        $this->app->singleton('adminconfiguration', \AvoRed\Framework\AdminConfiguration\Manager::class);
    }

    /**
     * Register the permission Manager Instance.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('adminconfiguration', function() {
            new Manager();
        });
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
            ->label('General');

        $configurationGroup->addConfiguration('general_site_title')
            ->label('Default Site Title')
            ->type('text')
            ->name('general_site_title');

        $configurationGroup->addConfiguration('general_site_description')
            ->label('Default Site Description')
            ->type('text')
            ->name('general_site_description');

        $siteCurrencyRepository = new SiteCurrencyRepository;
        $configurationGroup->addConfiguration('general_site_currency')
            ->label('Default Site Currency')
            ->type('select')
            ->name('general_site_currency')
            ->options($siteCurrencyRepository);

        $configurationGroup->addConfiguration('general_administrator_email')
            ->label('Administrator Email')
            ->type('text')
            ->name('general_administrator_email');

        $configurationGroup->addConfiguration('general_term_condition_page')
            ->label('Term & Condition Page')
            ->type('select')
            ->name('general_term_condition_page')
            ->options(function() {
                $options = Page::all()->pluck('name', 'id');
                return $options;
            });

        $configurationGroup->addConfiguration('general_home_page')
            ->label('Home Page')
            ->type('select')
            ->name('general_home_page')
            ->options(function() {
                $options = Page::all()->pluck('name', 'id');
                return $options;
            });

        $userGroup = AdminConfigurationFacade::add('users')
            ->label('Users');

        $userGroup->addConfiguration('user_default_country')
            ->label('User Default Country')
            ->type('select')
            ->name('user_default_country')
            ->options(function() {
                $options = Country::all()->pluck('name', 'id');
                return $options;
            });

        $userGroup->addConfiguration('user_activation_required')
            ->label('User Activation Required')
            ->type('select')
            ->name('user_activation_required')
            ->options(function() {
                $options = [0 => 'No', 1 => 'Yes'];
                return $options;
            });

        $shippingGroup = AdminConfigurationFacade::add('shipping')
            ->label('Shipping');

        $shippingGroup->addConfiguration('shipping_free_shipping_enabled')
            ->label('Is Free Shipping Enabled')
            ->type('select')
            ->name('shipping_free_shipping_enabled')
            ->options(function() {
                $options = [1 => 'Yes', 0 => 'No'];
                return $options;
            });

        $paymentGroup = AdminConfigurationFacade::add('payment')
            ->label('Payment');

        $paymentGroup->addConfiguration('payment_stripe_enabled')
            ->label('Payment Stripe Enabled')
            ->type('select')
            ->name('payment_stripe_enabled')
            ->options(function() {
                $options = [0 => 'No', 1 => 'Yes'];
                return $options;
            });

        $paymentGroup->addConfiguration('payment_stripe_publishable_key')
            ->label('Payment Stripe Publishable Key')
            ->type('text')
            ->name('payment_stripe_publishable_key');

        $paymentGroup->addConfiguration('avored_stripe_secret_key')
            ->label('Payment Stripe Secret Key')
            ->type('text')
            ->name('avored_stripe_secret_key');

        $taxGroup = AdminConfigurationFacade::add('tax')
            ->label('Tax');

        $taxGroup->addConfiguration('tax_enabled')
            ->label('Is Tax Enabled')
            ->type('select')
            ->name('tax_enabled')
            ->options(function() {
                $options = [1 => 'Yes', 0 => 'No'];
                return $options;
            });

        $taxGroup->addConfiguration('tax_percentage')
            ->label('Tax Percentage')
            ->type('text')
            ->name('tax_percentage');

        $taxGroup->addConfiguration('tax_default_country')
            ->label('Tax Default Country')
            ->type('select')
            ->name('tax_default_country')
            ->options(function() {
                $options = $options = Country::all()->pluck('name', 'id');
                return $options;
            });
    }
}
