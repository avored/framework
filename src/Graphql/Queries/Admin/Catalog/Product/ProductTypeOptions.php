<?php
namespace AvoRed\Framework\Graphql\Queries\Admin\Catalog\Product;

use AvoRed\Framework\Database\Models\Product;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Illuminate\Support\Collection;

class ProductTypeOptions extends Query
{
    protected $attributes = [
        'name' => 'ProductTypeOptions',
        'description' => 'A query'
    ];


    /**
     * Return type for these query
     * @return \GraphQL\Type\Definition\Type
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('option'));
    }

    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [];
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
     * @return Collection
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        $typeOptions = collect();
        $productTypes = Product::PRODUCT_TYPES;
        foreach ($productTypes as $typeValue => $typeLabel) {
            $typeOptions->push([
                'typeValue' => $typeValue,
                'typeLabel' => $typeLabel
            ]);
        }
        return $typeOptions;
    }
}
