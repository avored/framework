<?php

namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class SubscriberType extends GraphQLType
{
    /**
     * Attribute for Subscriber Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Subscriber',
        'description' => 'A type'
    ];

    /**
     * Fields for Subscriber Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the subscriber'
            ],
            'customer_id' => [
                'type' => Type::string(),
                'description' => 'The customer id of the subscriber'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the subscriber'
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'The status of the subscriber'
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the subscriber'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated_at of the subscriber'
            ],

        ];
    }
}
