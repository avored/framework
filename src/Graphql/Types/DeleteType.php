<?php
namespace AvoRed\Framework\Graphql\Types;

use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DeleteType extends GraphQLType
{

    /**
     * Attribute for Delete Type
     * @var array
     */
    protected $attributes = [
        'name' => 'DeleteType',
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
