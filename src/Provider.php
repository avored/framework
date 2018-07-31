<?php

namespace AvoRed\Framework;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Observers\ProductObserver;

class Provider extends ServiceProvider
{
    protected $providers = [
        \AvoRed\Framework\AdminMenu\Provider::class,
        \AvoRed\Framework\AdminConfiguration\Provider::class,
        \AvoRed\Framework\Breadcrumb\Provider::class,
        \AvoRed\Framework\Cart\Provider::class,
        \AvoRed\Framework\DataGrid\Provider::class,
        \AvoRed\Framework\Image\Provider::class,
        \AvoRed\Framework\Menu\Provider::class,
        \AvoRed\Framework\Models\Provider::class,
        \AvoRed\Framework\Modules\Provider::class,
        \AvoRed\Framework\Payment\Provider::class,
        \AvoRed\Framework\Permission\Provider::class,
        \AvoRed\Framework\Shipping\Provider::class,
        \AvoRed\Framework\Tabs\Provider::class,
        \AvoRed\Framework\Theme\Provider::class,
        \AvoRed\Framework\Widget\Provider::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerEventObserver();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
        $this->registerConfigData();
    }

    /**
     * Registering AvoRed E commerce Services
     * e.g Admin Menu.
     *
     * @return void
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            App::register($provider);
        }
    }

    /**
     * Register AvoRed Framework Resources here.
     * @return void
     */
    public function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-framework');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        //At this stage we don't use these and use avored/framework/database/migration file only
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function registerConfigData()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/avored-framework.php', 'avored-framework');

        $avoredConfigData   = include __DIR__ . '/../config/avored-framework.php';
        $fileSystemConfig   = $this->app['config']->get('filesystems', []);
        $authConfig         = $this->app['config']->get('auth', []);

        $this->app['config']->set(
                    'filesystems', 
                    array_merge_recursive($avoredConfigData['filesystems'], $fileSystemConfig)
                );
        $this->app['config']->set(
                    'auth', 
                    array_merge_recursive($avoredConfigData['auth'], $authConfig)
                );
    }

    public function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../config/avored-framework.php' => config_path('avored-framework.php'),
        ]);
    }

    /**
     * Register an Event Observer for the Database Model
     * @return void
     */
    public function registerEventObserver()
    {
        Product::observe(ProductObserver::class);
    }
}
