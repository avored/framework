<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class OptionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Option',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'typeValue' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Type Value'
            ],
            'typeLabel' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Type Label'
            ],
        ];
    }
}
