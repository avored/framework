<?php

namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Rebing\GraphQL\GraphQLServiceProvider;

class GraphqlProvider extends ServiceProvider
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
        $this->registerConfigData();
        $this->registerRebingLaravelGraphQlProvider();
    }

    /**
     * Bind The Eloquent Model with their contract.
     *
     * @return void
     */
    protected function registerRebingLaravelGraphQlProvider()
    {
        App::register(GraphQLServiceProvider::class);
    }

    /**
     * Register config data for AvoRed E commerce Framework
     * @return void
     */
    public function registerConfigData()
    {
        $avoredConfigData = include __DIR__ . '/../../../config/avored.php';
        $this->app['config']->set('graphql', $avoredConfigData['graphql']);
    }
}
