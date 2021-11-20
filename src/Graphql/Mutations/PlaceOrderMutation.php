<?php

namespace AvoRed\Framework\Graphql\Mutations;

use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Contracts\OrderProductModelInterface;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class PlaceOrderMutation extends Mutation
{
    use AuthorizedTrait;

    protected $attributes = [
        'name' => 'placeOrderMutation',
        'description' => 'A mutation'
    ];

    /**
     * Order Repository
     * @var AvoRed\Framework\Database\Repository\OrderRepository
     */
    protected $orderRepository;
    /**
     * OrderProduct Repository
     * @var AvoRed\Framework\Database\Repository\OrderProductRepository
     */
    protected $orderProductRepository;

    /**
     * All Order construct
     * @param \AvoRed\Framework\Database\Contracts\OrderModelInterface $orderRepository
     * @param \AvoRed\Framework\Database\Contracts\OrderProductModelInterface $orderProductRepository
     * @return void
     */
    public function __construct(
        OrderModelInterface $orderRepository,
        OrderProductModelInterface $orderProductRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
    }

    public function type(): Type
    {
        return GraphQL::type('order');
    }

    public function args(): array
    {
        return [
            'shipping_option' => [
                'name' => 'shipping_option',
                'type' => Type::nonNull(Type::string()),
            ],
            'payment_option' => [
                'name' => 'payment_option',
                'type' => Type::nonNull(Type::string())
            ],
            'order_status_id' => [
                'name' => 'order_status_id',
                'type' => Type::nonNull(Type::string())
            ],
            'customer_id' => [
                'name' => 'customer_id',
                'type' => Type::nonNull(Type::string())
            ],

            'shipping_address_id' => [
                'name' => 'shipping_address_id',
                'type' => Type::nonNull(Type::string())
            ],
            'billing_address_id' => [
                'name' => 'billing_address_id',
                'type' => Type::nonNull(Type::string())
            ],
            'products' => [
                'name' => 'products',
                'type' => Type::listOf(new InputObjectType([
                    'name' => 'order_products',
                    'fields' => [
                        'product_id' => ['name' => 'product_id', 'type' => Type::nonNull(Type::string())],
                        'qty' => ['name' => 'qty', 'type' => Type::nonNull(Type::float())],
                        'price' => ['name' => 'price', 'type' => Type::nonNull(Type::float())],
                        'tax_amount' => ['name' => 'tax_amount', 'type' => Type::nonNull(Type::float())],
                    ]
                ]))
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $order = $this->orderRepository->create($args);
        $this->syncProducts($order, $args);

        return $order;
    }


    /**
     * Sync Products and Attributes with Order Tables.
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @param array $args
     * @return void
     */
    private function syncProducts(Order $order, $args)
    {

        foreach ($args['products'] as $product) {
            $orderProductData = [
                'product_id' => $product['product_id'],
                'order_id' => $order->id,
                'qty' => $product['qty'],
                'price' => $product['price'],
                'tax_amount' => $product['tax_amount'],
            ];
            $orderProductModel = $this->orderProductRepository->create($orderProductData);
        }
    }
}
