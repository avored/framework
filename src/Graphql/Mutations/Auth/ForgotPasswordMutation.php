<?php

namespace AvoRed\Framework\Graphql\Mutations\Auth;

use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use AvoRed\Framework\Database\Contracts\VisitorModelInterface;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Nyholm\Psr7\ServerRequest;
use stdClass;

class ForgotPasswordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'forgotPassword',
        'description' => 'A mutation'
    ];

    /**
     * Customer Repository
     * @var AvoRed\Framework\Database\Repository\CustomerRepository
     */
    protected $customerRepository;

    /**
     * All Visitor construct
     * @param \AvoRed\Framework\Database\Contracts\VisitorModelInterface $visitorRepository
     * @return void
     */
    public function __construct(
        CustomerModelInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function type(): Type
    {
        return GraphQL::type('notification');
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $response = $this->broker()->sendResetLink(['email' => $args['email']]);

        if ($response === Password::RESET_LINK_SENT) {
            return ['success' => true,
                'message' => __('avored::system.success_sent_password_reset_email_message')
            ];
        }
    }


    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('customers');
    }
}
