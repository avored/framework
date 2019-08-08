<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\MenuGroup;
use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;
use Illuminate\Database\Eloquent\Collection;

class MenuGroupRepository implements MenuGroupModelInterface
{
    /**
     * Create MenuGroup Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function create(array $data): MenuGroup
    {
        return MenuGroup::create($data);
    }

    /**
     * Find MenuGroup Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function find(int $id): MenuGroup
    {
        return MenuGroup::find($id);
    }

    /**
     * Delete MenuGroup Resource from a database
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return MenuGroup::destroy($id);
    }

    /**
     * Get all the categories from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $menuGroups
     */
    public function all() : Collection
    {
        return MenuGroup::all();
    }
}
