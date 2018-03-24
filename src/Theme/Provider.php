<?php

namespace AvoRed\Framework\Theme;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Theme\Facade as Theme;

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerTheme();
        $this->app->alias('theme', 'AvoRed\Framework\Theme\Manager');

        $this->registerThemeConsoleProvider();

        $themes = Theme::all();
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerTheme()
    {
        $this->app->singleton('theme', function ($app) {
            $loadDefaultLangPath = base_path('themes/avored/default/lang');
            $app['path.lang'] = $loadDefaultLangPath;

            return new Manager($app['files']);
        });
    }

    /*
     * Register Module console Command which Register most Module generation Command
     *
     * @return void
     */
    public function registerThemeConsoleProvider()
    {
        $this->app->register('AvoRed\Framework\Theme\Console\Provider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['theme', 'AvoRed\Framework\Theme\Manager'];
    }
}
