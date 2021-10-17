<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class CustomerType extends GraphQLType
{
    /**
     * Attribute for Customer Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Customer',
        'description' => 'A type'
    ];

    /**
     * Fields for Customer Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'first_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The customer for the first name'
            ],
            'last_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The customer for the last name'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The customer for the email'
            ],
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The customer for the id'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Customer created at'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Customer updated at'
            ],
        ];
    }
}
