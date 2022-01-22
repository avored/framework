<?php

namespace AvoRed\Framework\Graphql\Mutations\Cart;

use AvoRed\Framework\Cart\Cart;
use AvoRed\Framework\Cart\CartManager;
use AvoRed\Framework\Database\Contracts\CartProductModelInterface;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class AddToCartMutation extends Mutation
{
    // use AuthorizedTrait;

    protected $attributes = [
        'name' => 'addToCart',
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
        return Type::listOf(GraphQL::type('cartProduct'));
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

        $visitor = $args['visitor_id'] ?? Uuid::uuid4()->__toString();
        Cart::visitor($visitor);
        Cart::add($args['slug'], $qty);

        return Cart::all();
    }
}
