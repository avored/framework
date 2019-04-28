<?php

namespace AvoRed\Framework\GraphQL\Mutation\Auth;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\Client;
use Zend\Diactoros\ServerRequest;
use function GuzzleHttp\json_decode;
use Rebing\GraphQL\Support\Facades\GraphQL;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Login extends Mutation
{
    protected $attributes = [
        'name' => 'Auth',
        'description' => 'A mutation'
    ];
    public function type()
    {
        return GraphQL::type('token');
    }

   
    public function args()
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
    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $user = $this->getUser($args);
        $client = $user->getPassportClient();
        
        Config::set('auth.guards.api.provider', 'admin-users');
        
        if (null !== $client && $client instanceof Client) {
            $serverRequest = $this->createRequest($client, $user->id, $args, $scope = []);
            $reponse = app(AccessTokenController::class)->issueToken($serverRequest);
            return json_decode($reponse->content());
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
        $userRepository = app(AdminUserModelInterface::class);
        $tokenRepository = app(TokenRepository::class);
        return $userRepository->findByEmail($data['email']);
    }
}
