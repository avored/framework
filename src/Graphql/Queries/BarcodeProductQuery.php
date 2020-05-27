<?php
namespace AvoRed\Framework\Graphql\Queries;

use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Models\Product;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class BarcodeProductQuery extends Query
{
    protected $attributes = [
        'name' => 'BarcodeProduct',
        'description' => 'A query'
    ];

    /**
     * Product Repository
     * @var AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * Product Query construct
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
        return GraphQL::type('product');
    }

    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [
            'barcode' => [
                'name' => 'barcode',
                'type' => Type::nonNull(Type::int())
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
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Product
    {
        return $this->productRepository->findByBarcode($args['barcode']);
    }
}
