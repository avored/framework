<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Api\Controllers\Controller;
use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Api\Resources\User\UserCollectionResource;
use AvoRed\Framework\Api\Resources\User\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return new UserCollectionResource($users);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }
}
