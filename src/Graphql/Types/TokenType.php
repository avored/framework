<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class TokenType extends GraphQLType
{
    /**
     * Attribute for Token Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Token',
        'description' => 'A type'
    ];

    /**
     * Fields for Token Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'token_type' => [
                'type' => Type::string(),
                'description' => 'Customer updated at'
            ],
            'expires_in' => [
                'type' => Type::int(),
                'description' => 'Customer updated at'
            ],
            'access_token' => [
                'type' => Type::string(),
                'description' => 'Customer updated at'
            ],
            'refresh_token' => [
                'type' => Type::string(),
                'description' => 'Customer updated at'
            ],
        ];
    }
}
