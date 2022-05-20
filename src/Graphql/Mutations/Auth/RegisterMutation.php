<?php

namespace AvoRed\Framework\Graphql\Mutations\Auth;

use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Laravel\Passport\Client;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Nyholm\Psr7\ServerRequest;
use stdClass;

class RegisterMutation extends Mutation
{
    protected $attributes = [
        'name' => 'register',
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
    public function __construct(
        CustomerModelInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function type(): Type
    {
        return GraphQL::type('Customer');
    }

    /**
     * Setup the Validation rules for register mutation
     *
     * @return array $rules
     */
    protected function rules(array $rules = []): array
    {
        return [
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'confirmed', 'max:255'],
        ];
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
                'type' => Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string())
            ],
            'password_confirmation' => [
                'name' => 'password_confirmation',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $customer = $this->customerRepository->create($args);

        $client = $customer->getPassportClient();

        if (null !== $client && $client instanceof Client) {
            $serverRequest = $this->createRequest($client, $customer->id, $args, $scope = []);
            $reponse = app(AccessTokenController::class)->issueToken($serverRequest);
            $data = json_decode($reponse->content(), true);

            $customer->token_type = $data['token_type'];
            $customer->expires_in = $data['expires_in'];
            $customer->access_token = $data['access_token'];
            $customer->refresh_token = $data['refresh_token'];

            return $customer;
        }

        return null;
    }

    /**
     * Create a request instance for the given client.
     *
     * @param  \Laravel\Passport\Client  $client
     * @param  mixed  $userId
     * @param  array  $scopes
     * @return \Nyholm\Psr7\ServerRequest
     */
    protected function createRequest($client, $userId, $data, array $scopes)
    {
        return (new ServerRequest('POST', 'not-important'))->withParsedBody([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $data['email'],
            'password' => $data['password'],
            'user_id' => $userId,
            'scope' => implode(' ', $scopes),
        ]);
    }
}
