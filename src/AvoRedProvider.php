<?php

namespace AvoRed\Framework;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Console\InstallCommand;
use Illuminate\Support\Facades\App;
use AvoRed\Framework\Support\Middleware\AdminAuth;
use AvoRed\Framework\Support\Middleware\RedirectIfAdminAuth;
use AvoRed\Framework\Support\Console\AdminMakeCommand;
use Illuminate\Support\Facades\View;
use AvoRed\Framework\System\ViewComposers\LayoutComposer;
use Laravel\Passport\Passport;

class AvoRedProvider extends ServiceProvider
{

    /**
     * Providers List for the Framework
     * @var array $providers
     */
    protected $providers = [
        //\AvoRed\Framework\AdminConfiguration\Provider::class,
        //\AvoRed\Framework\AdminMenu\AdminMenuProvider::class,
        //\AvoRed\Framework\Breadcrumb\BreadcrumbProvider::class,
        //\AvoRed\Framework\Cart\Provider::class,
        //\AvoRed\Framework\DataGrid\Provider::class,
        //\AvoRed\Framework\Image\ImageProvider::class,
        \AvoRed\Framework\Support\Providers\GraphqlProvider::class,
        \AvoRed\Framework\Support\Providers\MenuProvider::class,
        \AvoRed\Framework\Support\Providers\ModelProvider::class,
        \AvoRed\Framework\Support\Providers\ModuleProvider::class,
        //\AvoRed\Framework\Payment\Provider::class,
        //\AvoRed\Framework\Permission\PermissionProvider::class,
        //\AvoRed\Framework\Shipping\Provider::class,
        //\AvoRed\Framework\Tabs\Provider::class,
        //\AvoRed\Framework\Theme\Provider::class,
        //\AvoRed\Framework\Widget\WidgetProvider::class,
    ];


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
        $this->registerConfigData();
        $this->registerRoutePath();
        $this->registerMiddleware();
        $this->registerViewComposerData();
        $this->registerConsoleCommands();
        $this->registerMigrationPath();
        $this->registerViewPath();
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $this->registerTranslationPath();
        //$this->registerProviders();
    }

    /**
     * Register Route Path.
     *
     * @return void
     */
    public function registerRoutePath()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    /**
     * Register Console Commands.
     *
     * @return void
     */
    public function registerConsoleCommands()
    {
        $this->commands([InstallCommand::class]);
        $this->commands([AdminMakeCommand::class]);
    }

    /**
     * Register Migration Path.
     *
     * @return void
     */
    public function registerMigrationPath()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register View Path.
     *
     * @return void
     */
    public function registerViewPath()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'avored');
    }

    /**
     * Register Translation Path.
     *
     * @return void
     */
    public function registerTranslationPath()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'avored');
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
     * Registering AvoRed E commerce Middleware.
     *
     * @return void
     */
    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('admin.auth', AdminAuth::class);
        $router->aliasMiddleware('admin.guest', RedirectIfAdminAuth::class);
        //$router->aliasMiddleware('permission', Permission::class);
        //$router->aliasMiddleware('language', LanguageMiddleware::class);
        //$router->aliasMiddleware('currency', SiteCurrencyMiddleware::class);
        //$router->aliasMiddleware('admin.api.auth', AdminApiAuth::class);
    }

    /**
     * Register config data for AvoRed E commerce Framework
     * @return void
     */
    public function registerConfigData()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/avored.php',
            'avored'
        );
        $avoredConfigData = include __DIR__ . '/../config/avored.php';
        $fileSystemConfig = $this->app['config']->get('filesystems', []);
        $authConfig = $this->app['config']->get('auth', []);
        $this->app['config']->set(
            'filesystems',
            array_merge_recursive(
                $avoredConfigData['filesystems'],
                $fileSystemConfig
            )
        );
        $this->app['config']->set(
            'auth',
            array_merge_recursive($avoredConfigData['auth'], $authConfig)
        );
        // $graphqlConfig = $this->app['config']->get('graphql.schemas', []);
        // dd($graphqlConfig);
    }

    /**
     * Registering Class Based View Composer.
     * @return void
     */
    public function registerViewComposerData()
    {
        View::composer('avored::layouts.app', LayoutComposer::class);
    }
}
