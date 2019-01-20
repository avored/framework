<?php

namespace AvoRed\Framework\Theme;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Theme\Facade as Theme;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Load the Default Theme in the Boot method
     * @return void
     */
    public function boot()
    {
        $activeTheme = 'avored-default';
        $dbConnectError = false;

        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $dbConnectError = true;
        }

        if (false === $dbConnectError && Schema::hasTable('configurations')) {
            $repository = $this->app->get(ConfigurationInterface::class);
            $activeTheme = $repository->getValueByKey('active_theme_identifier');
        }
        $theme = Theme::get($activeTheme);
        $fallBackPath = base_path('resources/lang');
        $this->app['lang.path'] = array_get($theme, 'lang_path');
    }

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
     * Register the Them Provider instance.
     *
     * @return void
     */
    protected function registerTheme()
    {
        $this->app->singleton(
            'theme',
            function ($app) {
                $loadDefaultLangPath = base_path('resources/lang');
                $app['path.lang'] = $loadDefaultLangPath;
                return new Manager($app['files']);
            }
        );
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
