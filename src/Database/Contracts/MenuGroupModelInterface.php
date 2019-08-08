<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\MenuGroup;
use Illuminate\Database\Eloquent\Collection;

interface MenuGroupModelInterface
{
    /**
     * Create MenuGroup Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function create(array $data) : MenuGroup;

    /**
     * Find MenuGroup Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function find(int $id) : MenuGroup;

    /**
     * Delete MenuGroup Resource from a database
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All MenuGroup from the database
     * @return \Illuminate\Database\Eloquent\Collection $menuGroups
     */
    public function all() : Collection;
}
