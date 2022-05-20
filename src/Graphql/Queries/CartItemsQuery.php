<?php

namespace AvoRed\Framework\Graphql\Queries;

use AvoRed\Framework\Cart\Cart;
use AvoRed\Framework\Database\Models\Address;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CartItemsQuery extends Query
{
    // use AuthorizedTrait;

    protected $attributes = [
        'name' => 'cartItems',
        'description' => 'A query'
    ];


    public function type(): Type
    {
        return Type::listOf(GraphQL::type('CartProduct'));
    }



    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [
            'visitor_id' => [
                'name' => 'visitor_id',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }


    /**
     * Resolve Query to get pass an information
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo
     * @param midex $getSelectFields
     * @return Address
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        return Cart::visitor($args['visitor_id'])->all();
    }
}
