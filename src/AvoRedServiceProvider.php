<?php

namespace AvoRed\Framework;

use AvoRed\Framework\Breadcrumb\BreadcrumbProvider;
use AvoRed\Framework\Menu\MenuProvider;
use AvoRed\Framework\Support\Middleware\AdminAuth;
use AvoRed\Framework\Support\Middleware\Permission;
use AvoRed\Framework\Support\Middleware\RedirectIfAdminAuth;
use AvoRed\Framework\Support\Providers\ComponentsProvider;
use AvoRed\Framework\Support\Providers\ModelsProvider;
use AvoRed\Framework\System\Console\AdminMakeCommand;
use AvoRed\Framework\System\Console\InstallCommand;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AvoRedServiceProvider extends ServiceProvider
{
    protected $providers = [
        BreadcrumbProvider::class,
        ComponentsProvider::class,
        ModelsProvider::class,
        MenuProvider::class,
    ];

    public function register()
    {
        $this->registerProviders();
        $this->registerConfig();
        $this->registerConsoleCommands();
        $this->registerViewPath();
        $this->registerTranslationPath();
        $this->registerMiddleware();
    }

    public function boot()
    {
        $this->registerRoutes();
        $this->registerMigrationPath();
    }

    public function registerProviders()
    {
        foreach ($this->providers as $provider) {
            App::register($provider);
        }
    }

    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    public function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/avored.php', 'avored');
        $avoredConfigData = include __DIR__ . '/../config/avored.php';
        $authConfig = $this->app['config']->get('auth', []);

        $this->app['config']->set(
            'auth.guards',
            array_merge($authConfig['guards'], $avoredConfigData['auth']['guards'])
        );
        $this->app['config']->set(
            'auth.providers',
            array_merge($authConfig['providers'], $avoredConfigData['auth']['providers'])
        );
        $this->app['config']->set(
            'auth.passwords',
            array_merge($authConfig['passwords'], $avoredConfigData['auth']['passwords'])
        );
    }

    public function registerConsoleCommands()
    {
        $this->commands([InstallCommand::class]);
        $this->commands([AdminMakeCommand::class]);
    }

    public function registerMigrationPath()
    {
        $this->loadMigrationsFrom(__DIR__. '/../database/migrations');
    }

    public function registerViewPath()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored');
    }

    public function registerTranslationPath()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored');
    }

    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('admin.auth', AdminAuth::class);
        $router->aliasMiddleware('admin.guest', RedirectIfAdminAuth::class);
        $router->aliasMiddleware('permission', Permission::class);
    }
}
