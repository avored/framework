<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laragraph\Utils\RequestParser;
use Rebing\GraphQL\GraphQLController;
use Rebing\GraphQL\GraphQL;

class AvoRedGraphQLController extends GraphQLController
{
    public function query(Request $request, RequestParser $parser, Repository $config, GraphQL $graphql): JsonResponse
    {
        return parent::query($request, $parser, $config, $graphql);
    }
}
