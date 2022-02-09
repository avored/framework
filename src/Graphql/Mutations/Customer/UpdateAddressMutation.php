<?php

namespace AvoRed\Framework\Graphql\Mutations\Customer;

use AvoRed\Framework\Database\Contracts\AddressModelInterface;
use AvoRed\Framework\Database\Models\Address;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateAddressMutation extends Mutation
{
    use AuthorizedTrait;

    protected $attributes = [
        'name' => 'updateAddressMutation',
        'description' => 'A mutation'
    ];

    /**
     * Setup the Validation rules for create address mutation
     *
     * @return array $rules
     */
    protected function rules(array $rules = []): array
    {
        return [
            'id' => ['required', 'max:255'],
            'type' => ['required', 'in:' . Address::BILLING . ',' . Address::SHIPPING],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'company_name' => ['max:255'],
            'phone' => ['max:255'],
            'address1' => ['required', 'max:255'],
            'address2' => ['max:255'],
            'postcode' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'state' => ['required', 'max:255'],
            'country_id' => ['required', 'max:255'],
        ];
    }

    /**
     * Address Repository
     * @var AvoRed\Framework\Database\Repository\AddressRepository
     */
    protected $addressRepository;

    /**
     * All Address construct
     * @param \AvoRed\Framework\Database\Contracts\AddressModelInterface $addressRepository
     * @return void
     */
    public function __construct(AddressModelInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function type(): Type
    {
        return GraphQL::type('address');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
            ],
            'type' => [
                'name' => 'type',
                'type' => Type::nonNull(Type::string()),
            ],
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::nonNull(Type::string())
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => Type::nonNull(Type::string())
            ],
            'company_name' => [
                'name' => 'company_name',
                'type' => Type::string()
            ],
            'address1' => [
                'name' => 'address1',
                'type' => Type::nonNull(Type::string())
            ],
            'address2' => [
                'name' => 'address2',
                'type' => Type::string()
            ],
            'postcode' => [
                'name' => 'postcode',
                'type' => Type::nonNull(Type::string())
            ],
            'city' => [
                'name' => 'city',
                'type' => Type::nonNull(Type::string())
            ],
            'state' => [
                'name' => 'state',
                'type' => Type::nonNull(Type::string())
            ],
            'country_id' => [
                'name' => 'country_id',
                'type' => Type::nonNull(Type::string())
            ],
            'phone' => [
                'name' => 'phone',
                'type' => Type::string()
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $address = $this->addressRepository->find($args['id']);
        $address->update($args);

        return $address;
    }
}
