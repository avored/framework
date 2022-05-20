<?php

namespace AvoRed\Framework\Graphql\Queries;

use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class LatestProductQuery extends Query
{
    // use AuthorizedTrait;

    protected $attributes = [
        'name' => 'latestProductQuery',
        'description' => 'A query'
    ];

    /**
     * Product Repository
     * @var AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * All Product construct
     * @param \AvoRed\Framework\Database\Contracts\ProductModelInterface $productRepository
     * @return void
     */
    public function __construct(ProductModelInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Return type for these query
     * @return \GraphQL\Type\Definition\Type
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Product'));
    }

    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [];
    }

    /**
     * Resolve Query to get pass an information
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo
     * @param midex $getSelectFields
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        return $this->productRepository->query()->orderBy('updated_at', 'desc')->get();
    }
}
