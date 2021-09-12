<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository
{
    /**
     * All the Repository class must have an model method which should return the Model Class
     *
     */
    abstract function model();

    /**
     * Get Query Builder of the model
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder
    {
        return $this->model()->query();
    }

    /**
     * Create Model Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\BaseModel $model
     */
    public function create(array $data)
    {
        return $this->model()->create($data);
    }

    /**
     * Find Model Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Model $category
     */
    public function find(int $id)
    {
        return $this->model()->find($id);
    }

    /**
     * Delete Model Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->model()->delete($id);
    }

    /**
     * Get All Models Collection from the database.
     * @return \Illuminate\Database\Eloquent\Collection $models
     */
    public function all(): Collection
    {
        return $this->model()->all();
    }
}
