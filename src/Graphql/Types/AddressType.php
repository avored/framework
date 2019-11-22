<?php
namespace AvoRed\Framework\Graphql\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AddressType extends GraphQLType
{
    /**
     * Per Page Item
     * @var int
     */
    protected $perPage = 10;

    /**
     * Attribute for Address Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Address',
        'description' => 'A type'
    ];

     /**
     * Fields for Address Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the address'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The user id of the address'
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The type of the address'
            ],
            'first_name' => [
                'type' => Type::string(),
                'description' => 'The first name of the address'
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'The last name of the address'
            ],
            'company_name' => [
                'type' => Type::string(),
                'description' => 'The company name of the address'
            ],
            'address1' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The address1 of the address'
            ],
            'address2' => [
                'type' => Type::string(),
                'description' => 'The address2 of the address'
            ],
            'postcode' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The postcode of the address'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'The city of the address'
            ],
            'state' => [
                'type' => Type::string(),
                'description' => 'The state of the address'
            ],
            'country_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The country id of the address'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'The phone of the address'
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the address'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated_at of the address'
            ],
            
        ];
    }
}
