<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use stdClass;

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
            'image_path' => [
                'type' => Type::string(),
                'description' => 'The customer for the image path'
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
            'token_info' => [
                'type' => GraphQL::type('Token'),
                'description' => 'Customer Token Information'
            ],
            'addresses' => [
                'type' => Type::listOf(GraphQL::type('Address')),
                'description' => 'Customer Address List'
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
