<?php

namespace AvoRed\Framework\Api\Controllers;

use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Api\Resources\User\UserCollectionResource;
use AvoRed\Framework\Api\Resources\User\UserResource;

class UserController extends Controller
{
    /**
     * Return upto 10 Record for an Resource in Json Formate
     *
     * @return \Illuminate\Http\Resources\CollectsResources
     */
    public function index()
    {
        $users = User::paginate(10);

        return new UserCollectionResource($users);
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }
}
