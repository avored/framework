<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CartProductType extends GraphQLType
{
    /**
     * Attribute for Product Type
     * @var array
     */
    protected $attributes = [
        'name' => 'CartProduct',
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
            'visitor_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'CartProduct Visitor Id'
            ],
            'product_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'CartProduct product id'
            ],
            'price' => [
                'type' => Type::float(),
                'description' => 'CartProduct price'
            ],
            'qty' => [
                'type' => Type::float(),
                'description' => 'CartProduct qty'
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
