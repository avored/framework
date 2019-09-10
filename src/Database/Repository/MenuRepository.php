<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Contracts\MenuModelInterface;

class MenuRepository implements MenuModelInterface
{
    /**
     * Create Menu Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Menu $menu
     */
    public function create(array $data): Menu
    {
        return Menu::create($data);
    }

    /**
     * Find Menu Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Menu $menu
     */
    public function find(int $id): Menu
    {
        return Menu::find($id);
    }

    /**
     * Delete Menu Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Menu::destroy($id);
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $menus
     */
    public function all() : Collection
    {
        return Menu::all();
    }
}
