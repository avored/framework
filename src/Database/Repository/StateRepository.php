<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\State;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Contracts\StateModelInterface;

class StateRepository implements StateModelInterface
{
    /**
     * Create State Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\State $state
     */
    public function create(array $data): State
    {
        return State::create($data);
    }

    /**
     * Find State Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\State $state
     */
    public function find(int $id): State
    {
        return State::find($id);
    }

    /**
     * Delete State Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return State::destroy($id);
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $states
     */
    public function all() : Collection
    {
        return State::all();
    }
}
