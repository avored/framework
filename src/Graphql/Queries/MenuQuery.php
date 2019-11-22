<?php

declare(strict_types=1);

namespace AvoRed\Framework\Graphql\Queries;

use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class MenuQuery extends Query
{
    protected $attributes = [
        'name' => 'menu',
        'description' => 'A query'
    ];

    /**
     * Menu Group Repository
     * @var AvoRed\Framework\Database\Repository\MenuGroupRepository
     */
    protected $menuGroupRepository;

    /**
     * Menu Query construct
     * @param \AvoRed\Framework\Database\Contracts\MenuGroupModelInterface $menuGroupRepository
     * @return void
     */
    public function __construct(MenuGroupModelInterface $menuGroupRepository)
    {
        $this->menuGroupRepository = $menuGroupRepository;
    }

    /**
     * Return type for these query
     * @return \GraphQL\Type\Definition\Type
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('menu'));
    }

    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [
            'identifier' => [
                'name' => 'identifier',
                'type' => Type::nonNull(Type::string())
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
     * @return \Illuminate\Support\Collection $menus
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        return $this->menuGroupRepository->getTreeByIdentifier($args['identifier']);
    }
}
