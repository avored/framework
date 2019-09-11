<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\State;
use Illuminate\Database\Eloquent\Collection;

interface StateModelInterface
{
    /**
     * Create State Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\State $state
     */
    public function create(array $data) : State;

    /**
     * Find State Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\State $state
     */
    public function find(int $id) : State;

    /**
     * Delete State Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All State from the database.
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection;
}
