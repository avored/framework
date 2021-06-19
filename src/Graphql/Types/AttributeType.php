<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class AttributeType extends GraphQLType
{
    /**
     * Attribute for Attribute Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Attribute',
        'description' => 'A type'
    ];

     /**
     * Fields for Attribute Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the attribute'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name  of the attribute'
            ],
            'slug' => [
                'slug' => Type::nonNull(Type::string()),
                'description' => 'The slug of the attribute'
            ],
            'display_as' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The display as of the attribute'
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the attribute'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated_at of the attribute'
            ],
            
        ];
    }
}
