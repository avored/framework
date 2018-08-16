<?php

namespace AvoRed\Framework;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Api\Middleware\AdminApiAuth;
use AvoRed\Framework\User\Middleware\AdminAuth;
use AvoRed\Framework\User\Middleware\RedirectIfAdminAuth;
use AvoRed\Framework\User\Middleware\Permission;
use AvoRed\Framework\System\Middleware\SiteCurrencyMiddleware;
use AvoRed\Framework\User\ViewComposers\AdminUserFieldsComposer;
use AvoRed\Framework\System\ViewComposers\AdminNavComposer;
use AvoRed\Framework\Product\ViewComposers\CategoryFieldsComposer;
use AvoRed\Framework\Product\ViewComposers\ProductFieldsComposer;
use AvoRed\Framework\Cms\ViewComposers\PageFieldsComposer;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\View;
use AvoRed\Framework\User\Widget\TotalUserWidget;
use AvoRed\Framework\Order\Widget\TotalOrderWidget;
use AvoRed\Framework\Widget\Facade as WidgetFacade;
use Illuminate\Support\Carbon;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\KeysCommand;
use AvoRed\Framework\User\ViewComposers\SiteCurrencyFieldsComposer;
use AvoRed\Framework\Cms\ViewComposers\MenuComposer;

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
        $this->registerMiddleware();
        $this->registerViewComposerData();
        $this->registerResources();
        $this->registerPassportResources();
        $this->registerWidget();
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigData();
        Passport::ignoreMigrations();
        $this->registerProviders();
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
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-framework');
        //At this stage we don't use these and use avored/framework/database/migration file only
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function registerConfigData()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/avored-framework.php', 'avored-framework');

        $avoredConfigData = include __DIR__ . '/../config/avored-framework.php';
        
        $fileSystemConfig = $this->app['config']->get('filesystems', []);
        $authConfig = $this->app['config']->get('auth', []);
        $this->app['config']->set(
            'filesystems',
            array_merge_recursive($avoredConfigData['filesystems'], $fileSystemConfig)
        );
        $this->app['config']->set(
            'auth',
            array_merge_recursive($avoredConfigData['auth'], $authConfig)
        );
        $authConfig = $this->app['config']->get('auth', []);
        //dd($authConfig);

               
    }

    public function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../config/avored-framework.php' => config_path('avored-framework.php'),
        ]);
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
        $router->aliasMiddleware('permission', Permission::class);

        $router->aliasMiddleware('currency', SiteCurrencyMiddleware::class);
        $router->aliasMiddleware('admin.api.auth', AdminApiAuth::class);
    }

    /**
     * Registering Class Based View Composer.
     *
     * @return void
     */
    public function registerViewComposerData()
    {
        View::composer('avored-framework::layouts.left-nav', AdminNavComposer::class);
        View::composer('avored-framework::system.site-currency._fields', SiteCurrencyFieldsComposer::class);
        View::composer(['avored-framework::product.category._fields'], CategoryFieldsComposer::class);
        View::composer(['avored-framework::system.admin-user._fields'], AdminUserFieldsComposer::class);
        View::composer('avored-framework::cms.page._fields', PageFieldsComposer::class);
        View::composer('avored-framework::cms.menu.index', MenuComposer::class);
        View::composer(['avored-framework::product.create',
                        'avored-framework::product.edit',
                        ], ProductFieldsComposer::class);
    }

    /*
    *  Registering Passport Oauth2.0 client
    *
    * @return void
    */
    public function registerPassportResources()
    {
        Passport::ignoreMigrations();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        $this->commands([
          InstallCommand::class,
          ClientCommand::class,
          KeysCommand::class,
      ]);
    }


    /**
     * Register the Widget.
     *
     * @return void
     */
    protected function registerWidget()
    {
        $totalUserWidget = new TotalUserWidget();
        WidgetFacade::make($totalUserWidget->identifier(), $totalUserWidget);

        $totalOrderWidget = new TotalOrderWidget();
        WidgetFacade::make($totalOrderWidget->identifier(), $totalOrderWidget);
    }
}
