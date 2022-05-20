<?php

namespace AvoRed\Framework\Graphql\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PaymentType extends GraphQLType
{
    /**
     * Attribute for Product Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Payment',
        'description' => 'A type',
    ];

    /**
     * Fields for Payment Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Payment Name',
            ],
            'identifier' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Payment Identifier',
            ],
            'view' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Payment View',
            ],
        ];
    }

    /**
     * @param mixed $payment
     * @param array $args
     * @return string
     */
    protected function resolveNameField($payment, $args)
    {
        return $payment->name();
    }

    /**
     * @param mixed $payment
     * @param array $args
     * @return string
     */
    protected function resolveIdentifierField($payment, $args)
    {
        return $payment->identifier();
    }

    /**
     * @param mixed $payment
     * @param array $args
     * @return string
     */
    protected function resolveViewField($payment, $args)
    {
        return view($payment->view(), $payment->with());
    }
}
