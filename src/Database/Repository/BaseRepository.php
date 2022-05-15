<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    abstract function model();

    public function query(): Builder
    {
        return $this->model()->query();
    }

    public function create(array $data)
    {
        return $this->model()->create($data);
    }

    public function find(string $id): Model
    {
        return $this->model()->find($id);
    }

    public function delete(string $id): int
    {
        return $this->model()->destroy($id);
    }

    public function all(): Collection
    {
        return $this->model()->all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->model()->paginate();
    }
}
