<?php

namespace AvoRed\Framework\Graphql\Mutations\Customer;

use AvoRed\Framework\Database\Contracts\AddressModelInterface;
use AvoRed\Framework\Database\Models\Address;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteAddressMutation extends Mutation
{
    use AuthorizedTrait;

    protected $attributes = [
        'name' => 'deleteAddressMutation',
        'description' => 'A mutation'
    ];

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
        return GraphQL::type('delete');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if ($this->addressRepository->delete($args['id'])) {
            return ['success' => true, 'message' => __('avored::system.success_delete_message', ['attribute' => __('avored::system.address')])];
        }
        throw new Exception('There is an error while deleting an address model with given id:'. $args['id']);
    }
}
