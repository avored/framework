<?php
namespace AvoRed\Framework\GraphQL\Type\System;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class AdminUserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'AdminUserType',
        'description' => 'A type'
    ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The User Id of an Admin User'
            ],
            'first_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The User First Name of an Admin User'
            ],
           
            'last_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The User Last Name of an Admin User'
            ],
           
        ];
    }
}
