<?php

namespace AvoRed\Framework\Graphql\Mutations\Admin\User;

use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Laravel\Passport\Client;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Zend\Diactoros\ServerRequest;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'adminLogin',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('token');
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $data = [];
        $user = $this->getUser($args);
        $client = $user->getPassportClient();
        $defaultProvider = config('auth.guards.api.provider');
        config(['auth.guards.api.provider' => 'admin-users']);
        
        if (null !== $client && $client instanceof Client) {
            $serverRequest = $this->createRequest($client, $user->id, $args, $scope = []);
            $reponse = app(AccessTokenController::class)->issueToken($serverRequest);
            $data = json_decode($reponse->content(), true);
           
            config(['auth.guards.api.provider' => $defaultProvider]);
            $user->token_type = $data['token_type'];
            $user->expires_in = $data['expires_in'];
            $user->access_token = $data['access_token'];
            $user->refresh_token = $data['refresh_token'];
           
            return $user;
        }
        
        return null;
    }

     /**
     * Create a request instance for the given client.
     *
     * @param  \Laravel\Passport\Client  $client
     * @param  mixed  $userId
     * @param  array  $scopes
     * @return \Zend\Diactoros\ServerRequest
     */
    protected function createRequest($client, $userId, $data, array $scopes)
    {
        return (new ServerRequest)->withParsedBody([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $data['email'],
            'password' => $data['password'],
            'user_id' => $userId,
            'scope' => implode(' ', $scopes),
        ]);
    }
    /**
     * Get Admin User Model By Given Data
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AdminUser
     */
    protected function getUser($data) : AdminUser
    {
        $repository = app(AdminUserModelInterface::class);

        return $repository->findByEmail($data['email']);
    }
}
