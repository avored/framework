<?php
namespace AvoRed\Framework\GraphQL\Type\Auth;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class TokenType extends GraphQLType
{
    protected $attributes = [
        'name' => 'TokenType',
        'description' => 'A type'
    ];
    public function fields()
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
        ];
    }
}
