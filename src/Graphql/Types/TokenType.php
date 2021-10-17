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
                'type' => Type::nonNull(Type::string()),
                'description' => 'The token type for the access token'
            ],
            'expires_in' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The token expired in timestamp'
            ],
            'access_token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The access token of the user'
            ],
            'refresh_token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The refresh token of the user'
            ]
        ];
    }
}
