<?php

namespace AvoRed\Framework\Graphql\Mutations\Customer;

use AvoRed\Framework\Database\Contracts\SubscriberModelInterface;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateSubscriberMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateSubscriberMutation',
        'description' => 'A mutation',
    ];

    /**
     * Subscriber Repository
     * @var AvoRed\Framework\Database\Repository\SubscriberRepository
     */
    protected $subscriberRepository;

    /**
     * All Subscriber construct
     * @param \AvoRed\Framework\Database\Contracts\SubscriberModelInterface $subscriberRepository
     * @return void
     */
    public function __construct(SubscriberModelInterface $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    public function type(): Type
    {
        return GraphQL::type('Subscriber');
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        dd('fixed this one');
        $args['status'] = 'ENABLED';

        return $this->subscriberRepository->create($args);
    }
}
