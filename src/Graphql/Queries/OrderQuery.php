<?php
namespace AvoRed\Framework\Graphql\Queries;

use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class OrderQuery extends Query
{
    protected $attributes = [
        'name' => 'order',
        'description' => 'A query'
    ];

    /**
     * Order  Repository
     * @var AvoRed\Framework\Database\Repository\OrderRepository
     */
    protected $orderRepository;

    /**
     * Order Query construct
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
        return Type::listOf(GraphQL::type('order'));
    }

    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [
        ];
    }

    /**
     * Resolve Query to get pass an information
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo
     * @param midex $getSelectFields
     * @return \Illuminate\Support\Collection $orders
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        $user = Auth::user();
        return $this->orderRepository->findByUserId($user->id);
    }
}
