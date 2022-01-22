<?php

namespace AvoRed\Framework\Graphql\Mutations\Cart;

use AvoRed\Framework\Cart\Cart;
use AvoRed\Framework\Cart\CartManager;
use AvoRed\Framework\Database\Contracts\CartProductModelInterface;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteCartMutation extends Mutation
{
    use AuthorizedTrait;

    protected $attributes = [
        'name' => 'DeleteCart',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('cartProduct'));
    }

    public function args(): array
    {
        return [
            'slug' => [
                'name' => 'slug',
                'type' => Type::nonNull(Type::string()),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        Cart::destroy($args['slug']);
        dd('fix this one');

        return $visitor->cartProducts;
    }
}
