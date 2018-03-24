<?php

namespace AvoRed\Framework\Repository;

abstract class AbstractRepository
{
    public function create($attributes)
    {
        return $this->model()->create($attributes);
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }
}
