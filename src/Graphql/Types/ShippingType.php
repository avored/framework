<?php

namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class ShippingType extends GraphQLType
{
    /**
     * Attribute for Product Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Shipping',
        'description' => 'A type'
    ];

    /**
     * Fields for Shipping Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Shipping Name'
            ],
            'identifier' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Shipping Identifier'
            ],
            'view' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Shipping View'
            ],
        ];
    }

    /**
     * @param mixed $shipping
     * @param array $args
     * @return string
     */
    protected function resolveNameField($shipping, $args)
    {
        return $shipping->name();
    }

    /**
     * @param mixed $shipping
     * @param array $args
     * @return string
     */
    protected function resolveIdentifierField($shipping, $args)
    {
        return $shipping->identifier();
    }

    /**
     * @param mixed $shipping
     * @param array $args
     * @return string
     */
    protected function resolveViewField($shipping, $args)
    {
        return view($shipping->view(), $shipping->with());
    }
}
