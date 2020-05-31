<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface BaseInterface
{
     /**
     * Get Pagination of the model
     * @param int $perPage
     * @return Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 10) : LengthAwarePaginator;
}
