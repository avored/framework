<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CustomerType extends GraphQLType
{
    /**
     * Attribute for Customer Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Customer',
        'description' => 'A type'
    ];

    /**
     * Fields for Customer Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'first_name' => [
                'type' => Type::string(),
                'description' => 'The customer for the first name'
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'The customer for the last name'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The customer for the email'
            ],
            'id' => [
                'type' => Type::string(),
                'description' => 'The customer for the id'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Customer created at'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Customer updated at'
            ],
            'token_type' => [
                'type' => Type::string(),
                'description' => 'Customer updated at'
            ],
            'expires_in' => [
                'type' => Type::int(),
                'description' => 'Customer updated at'
            ],
            'access_token' => [
                'type' => Type::string(),
                'description' => 'Customer updated at'
            ],
            'refresh_token' => [
                'type' => Type::string(),
                'description' => 'Customer updated at'
            ],
            'addresses' => [
                'type' => Type::listOf(GraphQL::type('address')),
                'description' => 'Customer updated at'
            ],
        ];
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Customer  $customer
     * @param array $args
     * @return string $taxAmount
     */
    protected function resolveAddressesField($customer, $args)
    {
        return $customer->addresses;
    }
}
