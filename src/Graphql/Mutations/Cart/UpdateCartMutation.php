<?php

namespace AvoRed\Framework\Graphql\Mutations\Cart;

use AvoRed\Framework\Cart\Cart;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Ramsey\Uuid\Uuid;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateCartMutation extends Mutation
{
    // use AuthorizedTrait;

    protected $attributes = [
        'name' => 'updateCart',
        'description' => 'A mutation'
    ];

    /**
     * All Address construct
     * @return void
     */
    public function __construct()
    {
//        $this->cartProductRepository = $cartProductRepository;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('CartProduct'));
    }

    public function args(): array
    {
        return [
            'visitor_id' => [
                'name' => 'visitor_id',
                'type' => Type::string(),
            ],
            'slug' => [
                'name' => 'slug',
                'type' => Type::nonNull(Type::string()),
            ],
            'qty' => [
                'name' => 'qty',
                'type' => Type::float(),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $qty = $args['qty'] ?? 1;

        Cart::visitor($args['visitor_id']);
        Cart::update($args['slug'], $qty);

        return Cart::all();
    }
}
