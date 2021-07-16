<?php
namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Rebing\GraphQL\GraphQL;

class GraphqlProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        $this->registerConfigData();
        $this->registerMiddleware();
        $this->registerGraphqlData();
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $this->registerRebingGraphqlProvider();
    }

    /**
     * Registering Dynamic Schemas & Types
     * @param \Rebing\GraphQL\GraphQL $graphql
     * @return void
     */
    public function registerGraphqlData(): void
    {
        $this->app->afterResolving('graphql', function (GraphQL $graphql) {
            $this->bootSchemas($graphql);
            $this->bootTypes($graphql);
        });
    }

    /**
     * Add types from config.
     * @param \Rebing\GraphQL\GraphQL $graphql
     * @return void
     */
    protected function bootTypes(GraphQL $graphql): void
    {
        $configTypes = config('graphql.types');
        $graphql->addTypes($configTypes);
    }

    /**
     * Add schemas from config.
     * @param \Rebing\GraphQL\GraphQL $graphql
     * @return void
     */
    protected function bootSchemas(GraphQL $graphql): void
    {
        $configSchemas = config('graphql.schemas');
        foreach ($configSchemas as $name => $schema) {
            $graphql->addSchema($name, $schema);
        }
    }

    /**
     * Rebing Grahpql Service Provider to Add Dynamic Schema and register types,query & mutation
     * @return void
     */
    protected function registerRebingGraphqlProvider(): void
    {
        App::register(\Rebing\GraphQL\GraphQLServiceProvider::class, true);
    }

    /**
     * Registering AvoRed E commerce Middleware.
     * @return void
     */
    protected function registerMiddleware()
    {
        // $router->aliasMiddleware('admin.auth', AdminAuth::class);
        // $router->aliasMiddleware('admin.guest', RedirectIfAdminAuth::class);
        // $router->aliasMiddleware('avored', AvoRedCore::class);
    }

    /**
     * Register config data for AvoRed E commerce Framework
     * @return void
     */
    public function registerConfigData()
    {
        $avoredConfigData = include __DIR__ . '/../../../config/avored.php';
        $defaultGraphqlData = $this->app['config']->get('graphql', []);

        // dd($defaultGraphqlData, $avoredConfigData['graphql']);
        // dd($this->mergeConfigFrom($defaultGraphqlData, $avoredConfigData['graphql']));
        // $mergedConfig = $this->mergeConfigFrom($defaultGraphqlData, $avoredConfigData['graphql']);

        $mergedConfig = array_merge($defaultGraphqlData, $avoredConfigData['graphql']);
        $this->app['config']->set('graphql', $mergedConfig);
    }

    /**
     * Merges the configs together and takes multi-dimensional arrays into account.
     *
     * @param  array  $original
     * @param  array  $merging
     * @return array
     */
    protected function mergeConfigs(array $original, array $merging)
    {
        $array = array_merge($original, $merging);

        foreach ($original as $key => $value) {
            if (! is_array($value)) {
                continue;
            }

            if (! Arr::exists($merging, $key)) {
                continue;
            }

            if (is_numeric($key)) {
                continue;
            }

            $array[$key] = $this->mergeConfigs($value, $merging[$key]);
        }

        return $array;
    }
}
