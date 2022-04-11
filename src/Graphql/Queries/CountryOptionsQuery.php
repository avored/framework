<?php
namespace AvoRed\Framework\Graphql\Queries;

use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use AvoRed\Framework\Database\Models\Customer;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CountryOptionsQuery extends Query
{

    protected $attributes = [
        'name' => 'countryOptions',
        'description' => 'A query'
    ];

    /**
     * Customer Repository
     * @var AvoRed\Framework\Database\Repository\CustomerRepository
     */
    protected $customerRepository;


    /**
     * Return type for these query
     * @return \GraphQL\Type\Definition\Type
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Option'));
    }

    /**
     * Resolve Query to get pass an information
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo
     * @param midex $getSelectFields
     * @return Collection
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        return DB::table('countries')->get(['id', 'name']);
    }
}
