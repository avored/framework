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
        $this->app->singleton('adminconfiguration', function () {
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
            ->label('Geral');

        $configurationGroup->addConfiguration('general_site_title')
            ->label('Título do Site Padrão')
            ->type('text')
            ->name('general_site_title');

        $configurationGroup->addConfiguration('general_site_description')
            ->label('Descrição do Site Padrão')
            ->type('text')
            ->name('general_site_description');

        $siteCurrencyRepository = new SiteCurrencyRepository;
        $configurationGroup->addConfiguration('general_site_currency')
            ->label('Moeda do Site Padrão')
            ->type('select')
            ->name('general_site_currency')
            ->options($siteCurrencyRepository);

        $configurationGroup->addConfiguration('general_administrator_email')
            ->label('E-mail do Administrador')
            ->type('text')
            ->name('general_administrator_email');

        $configurationGroup->addConfiguration('general_term_condition_page')
            ->label('Página - Termos e Condições')
            ->type('select')
            ->name('general_term_condition_page')
            ->options(function () {
                $options = Page::all()->pluck('name', 'id');
                return $options;
            });

        $configurationGroup->addConfiguration('general_home_page')
            ->label('Página Inicial')
            ->type('select')
            ->name('general_home_page')
            ->options(function () {
                $options = Page::all()->pluck('name', 'id');
                return $options;
            });

        $userGroup = AdminConfigurationFacade::add('users')
            ->label('Usuários');

        $userGroup->addConfiguration('user_default_country')
            ->label('País Padrão')
            ->type('select')
            ->name('user_default_country')
            ->options(function () {
                $options = Country::all()->pluck('name', 'id');
                return $options;
            });

        $userGroup->addConfiguration('user_activation_required')
            ->label('Ativação de Usuário Obrigatório')
            ->type('select')
            ->name('user_activation_required')
            ->options(function () {
                $options = [0 => 'Não', 1 => 'Sim'];
                return $options;
            });

        $shippingGroup = AdminConfigurationFacade::add('shipping')
            ->label('Método de Entregas');

        $shippingGroup->addConfiguration('shipping_free_shipping_enabled')
            ->label('Ativar Frete Grátis?')
            ->type('select')
            ->name('shipping_free_shipping_enabled')
            ->options(function () {
                $options = [0 => 'Não', 1 => 'Sim'];
                return $options;
            });

        $paymentGroup = AdminConfigurationFacade::add('payment')
            ->label('Payment');

        $paymentGroup->addConfiguration('payment_stripe_enabled')
            ->label('Ativar Pagamento Stripe')
            ->type('select')
            ->name('payment_stripe_enabled')
            ->options(function () {
                $options = [0 => 'Não', 1 => 'Sim'];
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
            ->label('Ativar Taxa')
            ->type('select')
            ->name('tax_enabled')
            ->options(function () {
                $options = [0 => 'Não', 1 => 'Sim'];
                return $options;
            });

        $taxGroup->addConfiguration('tax_percentage')
            ->label('Porcentagem de Taxa')
            ->type('text')
            ->name('tax_percentage');

        $taxGroup->addConfiguration('tax_default_country')
            ->label('Tax Default Country')
            ->type('select')
            ->name('tax_default_country')
            ->options(function () {
                $options = $options = Country::all()->pluck('name', 'id');
                return $options;
            });
    }
}
