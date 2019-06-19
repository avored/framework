<?php
namespace AvoRed\Framework\GraphQL\Type\Catalog;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class CategoryType extends GraphQLType
{
    /**
     * Category type attributes
     * @var array $attributes
     */
    protected $attributes = [
        'name' => 'CategoryType',
        'description' => 'A type'
    ];
    
    /**
     * Category type fields
     * @return array $fields
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The Category Id of an category table'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The Category Name of an category table'
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The Category Slug of an category table'
            ],
            'meta_title' => [
                'type' => Type::string(),
                'description' => 'The category meta title of an category table'
            ],
            'meta_description' => [
                'type' => Type::string(),
                'description' => 'The category meta description of an category table'
            ],
           
        ];
    }
}
