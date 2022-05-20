<?php

namespace AvoRed\Framework;

use AvoRed\Framework\Breadcrumb\BreadcrumbProvider;
use AvoRed\Framework\Cart\CartProvider;
use AvoRed\Framework\Database\Models\OauthClient;
use AvoRed\Framework\Document\DocumentProvider;
use AvoRed\Framework\Menu\MenuProvider;
use AvoRed\Framework\Module\ModuleProvider;
use AvoRed\Framework\Payment\PaymentProvider;
use AvoRed\Framework\Permission\PermissionProvider;
use AvoRed\Framework\Shipping\ShippingProvider;
use AvoRed\Framework\Support\Middleware\AdminAuth;
use AvoRed\Framework\Support\Middleware\Permission as MiddlewarePermission;
use AvoRed\Framework\Support\Middleware\RedirectIfAdminAuth;
use AvoRed\Framework\Support\Providers\ComponentsProvider;
use AvoRed\Framework\Support\Providers\EventsProvider;
use AvoRed\Framework\Support\Providers\GraphqlProvider;
use AvoRed\Framework\Support\Providers\ModelsProvider;
use AvoRed\Framework\System\Composers\LayoutComposer;
use AvoRed\Framework\System\Console\AdminMakeCommand;
use AvoRed\Framework\System\Console\InstallCommand;
use AvoRed\Framework\Tab\TabProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AvoRedServiceProvider extends ServiceProvider
{
    /**
     * Providers List for the Framework.
     * @var array
     */
    protected $providers = [
        ModuleProvider::class,
        CartProvider::class,
        BreadcrumbProvider::class,
        ComponentsProvider::class,
        DocumentProvider::class,
        EventsProvider::class,
        GraphqlProvider::class,
        MenuProvider::class,
        ModelsProvider::class,
        PaymentProvider::class,
        PermissionProvider::class,
        ShippingProvider::class,
        TabProvider::class,
    ];

    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        $this->ignorePassport();
        $this->registerProviders();
        $this->registerConfigData();
        $this->registerRoutePath();
        $this->registerMiddleware();
        // $this->registerViewComposerData();
        $this->registerConsoleCommands();
        $this->registerMigrationPath();
        $this->registerViewPath();
        $this->registerAssets();
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $this->registerTranslationPath();
        $this->setupPublishFiles();
    }

    /**
     * Register Route Path.
     * @return void
     */
    public function ignorePassport()
    {
        Passport::ignoreMigrations();
        Passport::setClientUuids(true);
        Passport::useClientModel(OauthClient::class);
    }

    /**
     * Register Route Path.
     * @return void
     */
    public function registerRoutePath()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register Console Commands.
     * @return void
     */
    public function registerConsoleCommands()
    {
        $this->commands([InstallCommand::class]);
        $this->commands([AdminMakeCommand::class]);
    }

    /**
     * Register Migration Path.
     * @return void
     */
    public function registerMigrationPath()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register View Path.
     * @return void
     */
    public function registerViewPath()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored');
    }

    /**
     * Register Translation Path.
     * @return void
     */
    public function registerTranslationPath()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored');
    }

    /**
     * Registering AvoRed E commerce Service Provider.
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
     * @return void
     */
    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('admin.auth', AdminAuth::class);
        $router->aliasMiddleware('admin.guest', RedirectIfAdminAuth::class);
        $router->aliasMiddleware('permission', MiddlewarePermission::class);
        // $router->aliasMiddleware('avored', AvoRedCore::class);
    }

    /**
     * Register config data for AvoRed E commerce Framework.
     * @return void
     */
    public function registerConfigData()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/avored.php',
            'avored'
        );
        $avoredConfigData = include __DIR__ . '/../config/avored.php';
        $authConfig = $this->app['config']->get('auth', []);

        // $this->app['config']->set(
        //     'passport.client_uuids',
        //     true
        // );

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

    /**
     * Registering Class Based View Composer.
     * @return void
     */
    public function registerViewComposerData()
    {
        View::composer('avored::layouts.app', LayoutComposer::class);
    }

    /**
     * Registering AvoRed Assets.
     * @return void
     */
    public function registerAssets()
    {
        // Asset::registerJS(function (AssetItem $item) {
        //     $item->key('avored.avored.js')
        //     ->path(__DIR__ . '/../dist/js/avored.js');
        // });
        // Asset::registerJS(function (AssetItem $item) {
        //     $item->key('avored.app.js')
        //     ->path(__DIR__ . '/../dist/js/app.js');
        // });
        // Asset::registerCSS(function (AssetItem $item) {
        //     $item->key('avored.app.css')
        //     ->path(__DIR__ . '/../dist/css/app.css');
        // });
    }

    /**
     * Set up the file which can be published to use the package.
     * @return void
     */
    public function setupPublishFiles()
    {
        $this->publishes([
            __DIR__ . '/../config/avored.php' => config_path('avored.php'),
        ], 'avored-config');

        $this->publishes([
            __DIR__ . '/../dist' => public_path(),
        ], 'avored-public');
    }
}
