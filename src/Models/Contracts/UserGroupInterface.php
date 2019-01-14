<?php

namespace AvoRed\Framework\Models\Contracts;

interface UserGroupInterface
{
    /**
     * Find an  User by given Id which returns  User
     *
     * @param $id
     * @return \AvoRed\Framework\Models\User
     */
    public function find($id);

    /**
     * Find an All Users which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     *  User Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     *  User Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create an User
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\User
     */
    public function create($data);
}
