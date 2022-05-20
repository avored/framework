<?php

namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class OptionType extends GraphQLType
{
    /**
     * Attribute for Subscriber Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Option',
        'description' => 'A type'
    ];

    /**
     * Fields for Subscriber Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'value' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The value of the option'
            ],
            'label' => [
                'type' => Type::string(),
                'description' => 'The label of the option'
            ],
        ];
    }


    /**
     * @param  $country
     * @param array $args
     * @return string $taxAmount
     */
    protected function resolveValueField($country, $args)
    {
        return $country->id;
    }

    /**
     * @param  $country
     * @param array $args
     * @return string $taxAmount
     */
    protected function resolveLabelField($country, $args)
    {
        return $country->name;
    }
}
