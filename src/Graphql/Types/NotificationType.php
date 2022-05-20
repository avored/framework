<?php

namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class NotificationType extends GraphQLType
{
    /**
     * Attribute for Delete Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Notification',
        'description' => 'A type'
    ];

    /**
     * Fields for Delete Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'success' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'Success'
            ],
            'message' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Message'
            ]
        ];
    }
}
