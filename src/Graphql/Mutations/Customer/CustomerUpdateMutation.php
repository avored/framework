<?php

namespace AvoRed\Framework\Graphql\Mutations\Customer;

use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use AvoRed\Framework\Database\Models\Customer;
use AvoRed\Framework\Document\Document;
use AvoRed\Framework\Graphql\Traits\AuthorizedTrait;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CustomerUpdateMutation extends Mutation
{
    use AuthorizedTrait;

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
        return GraphQL::type('Customer');
    }

    public function args(): array
    {
        return [
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::nonNull(Type::string()),
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => Type::nonNull(Type::string())
            ],
            'profile_image' => [
                'name' => 'profile_image',
                'type' => GraphQL::type('Upload'),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var \Avored\Framework\Database\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();
        

        if (isset($args['profile_image'])) {
            $document = Document::uploadPublicly($args['profile_image']);
            $customer->imagePath()->updateOrCreate(optional($customer->imagePath)->toArray() ?? [], $document);
        }

        $customer->update($args);

        return $customer;
    }
}
