<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class MenuType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Menu',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Menu Id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Menu Name'
            ],
            'url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Menu url'
            ],
            'submenus' => [
                'type' => Type::listOf(GraphQL::type('menu')),
                'description' => 'Menus sub menus'
            ]
        ];
    }
}
