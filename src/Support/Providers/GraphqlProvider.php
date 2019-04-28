<?php

namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\ServiceProvider;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Config;

class GraphqlProvider extends ServiceProvider
{
    /**
     * Boot the Service Provider
     * @return void
     */
    public function boot()
    {
        $this->registerGraphqlTypes();
        $this->registerGraphqlSchema();
        $this->registerGuestSchemaRoute();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register Graphql Types for the AvoRed E commerce package
     * @return void
     */
    public function registerGraphqlTypes()
    {
        $types = config('avored.graphql.types');

        foreach ($types as $typeName => $typeClass) {
            GraphQL::addType($typeClass, $typeName);
        }
    }

    /**
     * Register Graphql Schema for the AvoRed E commerce package
     * @return void
     */
    public function registerGraphqlSchema()
    {
        $defaultSchema = config('avored.graphql.schemas.default');
        $defaultSchemaName = 'default';
        GraphQL::addSchema($defaultSchemaName, $defaultSchema);

        $guest = config('avored.graphql.schemas.guest');
        $name = 'guest';
        GraphQL::addSchema($name, $guest);
    }

    /**
     * register guest schema route
     * @return void
     */
    public function registerGuestSchemaRoute()
    {
        $guest = config('avored.graphql.schemas.guest');
        $name = 'guest';
        $controller = config('graphql.controllers', \Rebing\GraphQL\GraphQLController::class . '@query');
        $schemaParameterPattern = '/\{\s*graphql\_schema\s*\?\s*\}/';
        $queryRoute = '{graphql_schema?}';
        $router = $this->app['router'];

        foreach (array_get($guest, 'method', ['get', 'post']) as $method) {
            $route = $router->{$method}(
                GraphQL::routeNameTransformer($name, $schemaParameterPattern, $queryRoute),
                [
                    'uses'          => $controller,
                    'middleware'    => array_get($guest, 'middleware', []),
                ]
            );
        }
    }
}
