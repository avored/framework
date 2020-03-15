<?php

namespace AvoRed\Framework\Graphql\Mutations\Admin\Catalog\Category;

use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CategoryCreateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'adminCategoryCreate',
        'description' => 'A mutation'
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
        return GraphQL::type('category');
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return Auth::guard('admin_api')->check();
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
            ],
            'slug' => [
                'name' => 'slug',
                'type' => Type::nonNull(Type::string())
            ],
            'meta_title' => [
                'name' => 'meta_title',
                'type' => Type::string()
            ],
            'meta_description' => [
                'name' => 'meta_description',
                'type' => Type::string()
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return $this->categoryRepository->create($args);
    }
}
