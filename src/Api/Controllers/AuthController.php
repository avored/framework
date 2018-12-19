<?php
namespace AvoRed\Framework\Api\Controllers;


use AvoRed\Framework\Models\Database\User;

class AuthController extends Controller
{
    public function login()
    {
        $email = request()->get('username');
        $password = request()->get('password');

        $user = null;
        if(\Auth::guard('web')->attempt(['email'=>$email,'password'=>$password]))
        {
            $user = User::whereEmail($email)->first();
        }

        if (!$user) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }

        // Send an internal API request to get an access token
        $client = \DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        // Make sure a Password Client exists in the DB
        if (!$client) {
            return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
            ], 500);
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => request('username'),
            'password' => request('password'),
            'provider' => 'users'
        ];

        $request = \Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        // Check if the request was successful
        if ((int) $response->getStatusCode() != 200) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }

        // Get the data from the response
        $data = \json_decode($response->getContent());

        // Format the final response in a desirable format
        return response()->json([
            'access_token' => $data->access_token,
            'refresh_token' => $data->refresh_token,
            'user' => $user,
            'status' => 200
        ]);
    }
}
