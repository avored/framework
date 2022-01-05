<?php

namespace AvoRed\Framework\Graphql\Mutations\Auth;

use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use AvoRed\Framework\Database\Contracts\VisitorModelInterface;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Nyholm\Psr7\ServerRequest;
use stdClass;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'login',
        'description' => 'A mutation'
    ];

    /**
     * Visitor Repository
     * @var AvoRed\Framework\Database\Repository\VisitorRepository
     */
    protected $visitorRepository;

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
        VisitorModelInterface $visitorRepository,
        CustomerModelInterface $customerRepository
    ) {
        $this->visitorRepository = $visitorRepository;
        $this->customerRepository = $customerRepository;
    }

    public function type(): Type
    {
        return GraphQL::type('token');
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string()
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $data = [];
        $data = $this->createVisitorData();
        $visitor = $this->visitorRepository->create($data);

        if (!empty($args['email']) && !empty($args['password'])) {
            $customer = $this->customerRepository->findByEmail($args['email']);

            if (Hash::check($args['password'], $customer->password)) {
                $visitor->customer_id = $customer->id;
                $visitor->save();
            }
        }

        $args['email'] = $visitor->username;
        $args['password'] = $visitor->password;

        $client = $visitor->getPassportClient();

        if (null !== $client && $client instanceof Client) {
            $serverRequest = $this->createRequest($client, $visitor->id, $args, $scope = []);
            $reponse = app(AccessTokenController::class)->issueToken($serverRequest);
            $data = json_decode($reponse->content(), true);

            $token = new stdClass;
            $token->token_type = $data['token_type'];
            $token->expires_in = $data['expires_in'];
            $token->access_token = $data['access_token'];
            $token->refresh_token = $data['refresh_token'];

            return $token;
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
        // dd($data);
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

    public function createVisitorData()
    {
        $guestPrefix = config('avored.guest_prefix', 'Guest');
        return [
            'username' => $guestPrefix . Str::random(),
            'password' => Str::random(32)
        ];
    }
}
