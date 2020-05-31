<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseInterface
{
    /**
     * Get Pagination of the model
     * @param int $perPage
     * @return Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 10) : LengthAwarePaginator;

    /**
     * Create Model Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\BaseModel $model
     */
    public function create(array $data) : BaseModel;

    /**
     * Find Model Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Model $model
     */
    public function find(int $id) : BaseModel;

    /**
     * Delete Model Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All Models Collection from the database.
     * @return \Illuminate\Database\Eloquent\Collection $models
     */
    public function all() : Collection;
}
