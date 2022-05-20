<?php

namespace AvoRed\Framework\Graphql\Queries;

use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class OrderQuery extends Query
{
    use AuthorizedTrait;

    protected $attributes = [
        'name' => 'allOrders',
        'description' => 'A query',
    ];

    /**
     * Order Repository
     * @var AvoRed\Framework\Database\Repository\OrderRepository
     */
    protected $orderRepository;

    /**
     * All Order construct
     * @param \AvoRed\Framework\Database\Contracts\OrderModelInterface $orderRepository
     * @return void
     */
    public function __construct(OrderModelInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Return type for these query
     * @return \GraphQL\Type\Definition\Type
     */
    public function type(): Type
    {
        return GraphQL::type('Order');
    }

    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    /**
     * Resolve Query to get pass an information
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo
     * @param mixed $getSelectFields
     * @return Orderr
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Order
    {
        return $this->orderRepository->find($args['id']);
    }
}
