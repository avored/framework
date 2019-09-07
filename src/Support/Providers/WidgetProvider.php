<?php
namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\Widget\WidgetManager;
use Illuminate\Support\ServiceProvider;

class WidgetProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service provider.
     * @return void
     */
    public function boot()
    {
        $this->registerWidget();
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('widget', 'AvoRed\Framework\Widget\WidgetManager');
    }
    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton('widget', function ($app) {
            return new WidgetManager();
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['widget', 'AvoRed\Framework\Widget\WidgetManager'];
    }
    
    /**
     * Register the Widget
     * @return void
     */
    protected function registerWidget()
    {
        //
    }
}
