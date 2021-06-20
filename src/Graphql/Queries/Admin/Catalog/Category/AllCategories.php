<?php
namespace AvoRed\Framework\Graphql\Queries\Admin\Catalog\Category;

use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class AllCategories extends Query
{
    /**
     * Default Per Page
     * @var int $perPage
     */
    protected $perPage = 10;

    protected $attributes = [
        'name' => 'AllCategories',
        'description' => 'A query'
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
        return GraphQL::paginate('category');
    }

    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [
            'page' => [
                'name' => 'page',
                'type' => Type::int(),
            ],
        ];
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true; // Auth::guard('admin_api')->check();
    }

    /**
     * Resolve Query to get pass an information
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo
     * @param midex $getSelectFields
     * @return LengthAwarePaginator
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): LengthAwarePaginator
    {
        $page = (int) ($args['page'] ?? request('page', 1));

       
        return $this->categoryRepository->paginate($this->perPage, [], $page);
    }
}
