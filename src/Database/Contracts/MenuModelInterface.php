<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

interface MenuModelInterface
{
    /**
     * Create Menu Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Menu $menu
     */
    public function create(array $data) : Menu;

    /**
     * Find Menu Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Menu $menu
     */
    public function find(int $id) : Menu;

    /**
     * Delete Menu Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All Menu from the database.
     * @return \Illuminate\Database\Eloquent\Collection $menus
     */
    public function all() : Collection;
}
