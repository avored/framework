<?php

namespace AvoRed\Framework\Graphql\Queries;

use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CategoryQuery extends Query
{
    // use AuthorizedTrait;

    protected $attributes = [
        'name' => 'category',
        'description' => 'A query',
    ];

    /**
     * Category Repository
     * @var AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * All Category construct
     * @param \AvoRed\Framework\Database\Contracts\CategoryModelInterface $categoryRepository
     * @return void
     */
    public function __construct(CategoryModelInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Return type for these query
     * @return \GraphQL\Type\Definition\Type
     */
    public function type(): Type
    {
        return GraphQL::type('Category');
    }

    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [
            'slug' => [
                'name' => 'slug',
                'type' => Type::nonNull(Type::string()),
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int(),
            ],
        ];
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
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Category
    {
        return $this->categoryRepository->findBySlug($args['slug']);
    }
}
