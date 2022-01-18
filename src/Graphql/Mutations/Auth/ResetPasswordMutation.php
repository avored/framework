<?php

namespace AvoRed\Framework\Graphql\Mutations\Auth;

use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class ResetPasswordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'resetPassword',
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
            'token' => [
                'name' => 'token',
                'type' => Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
            ],
            'password_confirmation' => [
                'name' => 'password_confirmation',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $response = $this->broker()->reset($args, function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

      

        if ($response === Password::PASSWORD_RESET) {
            return ['success' => true,
                'message' => __('avored::system.success_reset_password_message')
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

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);
        $user->setRememberToken(Str::random(60));
        $user->save();
    }

    /**
     * Set the user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
    }
}
