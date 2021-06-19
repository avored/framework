<?php
namespace AvoRed\Framework\Graphql\Queries\Admin\Catalog\Attribute;

use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class AdminOptionsAttributes extends Query
{
    protected $attributes = [
        'name' => 'adminOptionsAttributes',
        'description' => 'A query'
    ];

    /**
     * Attribute Repository
     * @var AvoRed\Framework\Database\Repository\AttributeRepository
     */
    protected $attributeRepository;

    /**
     * All Attribute construct
     * @param \AvoRed\Framework\Database\Contracts\AttributeModelInterface $attributeRepository
     * @return void
     */
    public function __construct(AttributeModelInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Return type for these query
     * @return \GraphQL\Type\Definition\Type
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('attribute'));
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
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        // dd($this->attributeRepository->all());
        return $this->attributeRepository->all();
    }
}
