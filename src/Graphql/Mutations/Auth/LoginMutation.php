<?php

namespace AvoRed\Framework\Graphql\Mutations\Auth;

use App\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Laravel\Passport\Client;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Laminas\Diactoros\ServerRequest;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'login',
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
        
        if (null !== $client && $client instanceof Client) {
            $serverRequest = $this->createRequest($client, $user->id, $args, $scope = []);
            $reponse = app(AccessTokenController::class)->issueToken($serverRequest);
            $data = json_decode($reponse->content(), true);
            
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
     *
     * @param array $data
     * @return \App\Models\Auth\User
     */
    protected function getUser($data)
    {
        return User::whereEmail($data['email'])->first();
    }
}
