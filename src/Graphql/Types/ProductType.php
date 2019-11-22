<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProductType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Product',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Product Id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Name'
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Type'
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Slug'
            ],
            'sku' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product SKU'
            ],
            'barcode' => [
                'type' => Type::string(),
                'description' => 'Product Barcode'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Product Description'
            ],
            'status' => [
                'type' => Type::boolean(),
                'description' => 'Product Status'
            ],
            'in_stock' => [
                'type' => Type::boolean(),
                'description' => 'Product In Stock'
            ],
            'track_stock' => [
                'type' => Type::boolean(),
                'description' => 'Product Track Stock'
            ],
            'is_taxable' => [
                'type' => Type::boolean(),
                'description' => 'Product Is Taxable'
            ],
            'qty' => [
                'type' => Type::float(),
                'description' => 'Product Qty'
            ],
            'price' => [
                'type' => Type::float(),
                'description' => 'Product Price'
            ],
            'cost_price' => [
                'type' => Type::float(),
                'description' => 'Product Cost Price'
            ],
            'weight' => [
                'type' => Type::float(),
                'description' => 'Product Weight'
            ],
            'height' => [
                'type' => Type::float(),
                'description' => 'Product Height'
            ],
            'length' => [
                'type' => Type::float(),
                'description' => 'Product Length'
            ],
            'width' => [
                'type' => Type::float(),
                'description' => 'Product Width'
            ],
            'meta_title' => [
                'type' => Type::string(),
                'description' => 'Product Meta Title'
            ],
            'meta_description' => [
                'type' => Type::string(),
                'description' => 'Product Meta Description'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Product Created At'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Product Updated At'
            ],
        ];
    }
}
