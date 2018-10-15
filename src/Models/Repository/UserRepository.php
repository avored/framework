<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\UserInterface;
use AvoRed\Framework\Models\Database\User;

class UserRepository implements UserInterface
{
    /**
     * Find an User by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\User
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * Find an User by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Paginate User
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return User::paginate($noOfItem);
    }

    /**
     * Find an User Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::query();
    }

    /**
     * Find an User Query
     *
     * @return \AvoRed\Framework\Models\User
     */
    public function create($data)
    {
        return User::create($data);
    }
}
