<?php

namespace AvoRed\Framework\Graphql\Mutations\Admin\Catalog\Category;

use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use Closure;
use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CategoryDeleteMutation extends Mutation
{
    protected $attributes = [
        'name' => 'adminCategoryDelete',
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
        return GraphQL::type('delete');
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return Auth::guard('admin_api')->check();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if ($this->categoryRepository->delete($args['id'])) {
            return ['success' => true, 'message' => 'Category Destroyed successfully!'];
        }
        throw new Exception('There is an error while deleting an category model with given id:'. $args['id']);
    }
}
