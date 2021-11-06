<?php
namespace AvoRed\Framework\Graphql\Types;

use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProductType extends GraphQLType
{
    /**
     * Per Page Item
     * @var int
     */
    protected $perPage = 10;

    /**
     * Attribute for Product Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Product',
        'description' => 'A type'
    ];

    /**
     * Fields for Product Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Name'
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Slug'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Product Description'
            ],
            'meta_title' => [
                'type' => Type::string(),
                'description' => 'Product Meta title'
            ],
            'meta_description' => [
                'type' => Type::string(),
                'description' => 'Product Meta Description'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Product created at'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Product updated at'
            ],
        ];
    }
}
