<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Illuminate\Http\Request;
use Zend\Diactoros\ServerRequest;
use Laravel\Passport\Client;
use Laravel\Passport\TokenRepository;
use AvoRed\Framework\Models\Contracts\AdminUserInterface;

class LoginController extends AccessTokenController
{
    /**
     * Authorize a client to access the user's account.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface  $request
     * @return \Illuminate\Http\Response
     */
    public function token(Request $request)
    {
        $user = $this->getUser($request);
        
        $client = $user->clients->first();
        if (null !== $client && $client instanceof Client) {

            $serverRequest = $this->createRequest(
                $client,
                $user->id,
                $request, $scope = []
            );
            $reponse = parent::issueToken($serverRequest);
            $responseArray = json_decode($reponse->content(), true);
            unset($responseArray['refresh_token']);
            return response()->json($responseArray)
                ->setStatusCode($reponse->getStatusCode());
        }
        return response(['error' => 'Please create a client first'], 401);
    }

    /**
     * Create a request instance for the given client.
     *
     * @param  \Laravel\Passport\Client  $client
     * @param  mixed  $userId
     * @param  array  $scopes
     * @return \Zend\Diactoros\ServerRequest
     */
    protected function createRequest($client, $userId, $request, array $scopes)
    {
        return (new ServerRequest)->withParsedBody(
            ['grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request->get('email'),
            'password' => $request->get('password'),
            'user_id' => $userId,
            'scope' => implode(' ', $scopes)]
        );
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Auth\User
     */
    protected function getUser($request)
    {
        $userRepository = app(AdminUserInterface::class);
        $tokenRepository = app(TokenRepository::class);
        return $userRepository->query()->whereEmail($request->get('email'))->first();
    }
}
