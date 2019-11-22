<?php

namespace AvoRed\Framework\Graphql\Mutations\Cart;

use AvoRed\Framework\Support\Facades\Cart;
use Closure;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class AddToCartMutation extends Mutation
{
    protected $attributes = [
        'name' => 'addToCart',
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
            ],
            'qty' => [
                'name' => 'qty',
                'type' => Type::nonNull(Type::float()),
            ],
            'attributes' => [
                'name' => 'attributes',
                'type' => Type::listOf(new InputObjectType([
                    'name' => 'add_to_cart_attributes',
                    'fields' => [
                        'attribute_value_id' => ['name' => 'attribute_value_id', 'type' => Type::nonNull(Type::int())],
                    ]
                ]))
            ],

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $slug = $args['slug'] ?? 1;
        $qty = $args['qty'] ?? 1;
        $attributes = $args['attributes'] ?? [];

        list ($status, $message) = Cart::add($slug, $qty, $attributes);
        
        return Cart::all();
    }
}
