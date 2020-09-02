<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

interface BaseInterface
{
    /**
     * Get Pagination of the model
     * @param int $perPage
     * @param array $with
     * @return Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 10, array $with = []) : LengthAwarePaginator;

    /**
     * Get Query Builder of the model
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder;

    /**
     * Create Model Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\BaseModel $model
     */
    public function create(array $data);

    /**
     * Find Model Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Model $model
     */
    public function find(int $id);

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
