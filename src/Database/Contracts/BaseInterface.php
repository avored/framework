<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseInterface
{
    public function query(): Builder;

    public function create(array $data);

    public function find(string $id): Model;

    public function delete(string $id);

    public function all(): Collection;

    public function paginate(): LengthAwarePaginator;
}
