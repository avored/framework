<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseInterface
{
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
    public function find(string $id): Model;

    /**
     * Delete Model Resource from a database.
     * @param string $id
     * @return int
     */
    public function delete(string $id);

    /**
     * Get All Models Collection from the database.
     * @return \Illuminate\Database\Eloquent\Collection $models
     */
    public function all(): Collection;

    /**
     * Get All Models Collection from the database.
     * @return LengthAwarePaginator $models
     */
    public function paginate(): LengthAwarePaginator;
}
