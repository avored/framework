<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class FilterType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Filter',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Category Filter Id'
            ],
            'category_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Category Id'
            ],
            'filter_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Filter Id'
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Filter Type'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Filter Created At'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Filter Updated at'
            ],
        ];
    }
}
