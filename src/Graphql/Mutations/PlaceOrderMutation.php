<?php

namespace AvoRed\Framework\Graphql\Mutations;

use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Contracts\OrderProductModelInterface;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
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
     * OrderStatus Repository
     * @var AvoRed\Framework\Database\Repository\OrderStatusRepository
     */
    protected $orderStatusRepository;

    /**
     * All Order construct
     * @param \AvoRed\Framework\Database\Contracts\OrderModelInterface $orderRepository
     * @param \AvoRed\Framework\Database\Contracts\OrderProductModelInterface $orderProductRepository
     * @return void
     */
    public function __construct(
        OrderModelInterface $orderRepository,
        OrderProductModelInterface $orderProductRepository,
        OrderStatusModelInterface $orderStatusRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->orderStatusRepository = $orderStatusRepository;
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
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $orderStatus = $this->orderStatusRepository->findDefault();
        $args['order_status_id'] = $orderStatus->id;
        $order = $this->orderRepository->create($args);
        // $this->syncProducts($order, $args);

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
        //@todo add args to be with visitor id
        $products = Cart::all();
        foreach ($products as $product) {
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
