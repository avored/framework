<?php

namespace AvoRed\Framework\Graphql\Mutations\Cart;

use AvoRed\Framework\Cart\Cart;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteCartMutation extends Mutation
{
    protected $attributes = [
        'name' => 'DeleteCart',
        'description' => 'A mutation',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('CartProduct'));
    }

    public function args(): array
    {
        return [
            'slug' => [
                'name' => 'slug',
                'type' => Type::nonNull(Type::string()),
            ],
            'visitor_id' => [
                'name' => 'visitor_id',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        Cart::visitor($args['visitor_id']);
        Cart::destroy($args['slug']);

        return Cart::all();
    }
}
