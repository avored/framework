<?php

namespace AvoRed\Framework\Graphql\Mutations\Customer;

use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use AvoRed\Framework\Database\Models\Customer;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CustomerUpdateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'customerUpdate',
        'description' => 'A mutation'
    ];

    /**
     * Customer Repository
     * @var AvoRed\Framework\Database\Repository\CustomerRepository
     */
    protected $customerRepository;

    /**
     * All Customer construct
     * @param \AvoRed\Framework\Database\Contracts\CustomerModelInterface $customerRepository
     * @return void
     */
    public function __construct(CustomerModelInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function type(): Type
    {
        return GraphQL::type('customer');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
            ],
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::nonNull(Type::string()),
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $customer = $this->customerRepository->find($args['id']);
        $customer->update($args);

        return $customer;
    }
}
