<?php

namespace AvoRed\Framework\Graphql\Queries;

use AvoRed\Framework\Database\Contracts\AddressModelInterface;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class AllAddressQuery extends Query
{
    use AuthorizedTrait;

    protected $attributes = [
        'name' => 'allAddress',
        'description' => 'A query',
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

    /**
     * Return type for these query
     * @return \GraphQL\Type\Definition\Type
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Address'));
    }

    /**
     * Passed arguments for this query
     * @return array
     */
    public function args(): array
    {
        return [];
    }

    /**
     * Resolve Query to get pass an information
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo
     * @param midex $getSelectFields
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        $customer = Auth::guard('customer')->user();

        return $customer->addresses;
    }
}
