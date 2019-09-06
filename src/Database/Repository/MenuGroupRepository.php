<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\MenuGroup;
use Illuminate\Support\Collection as SupportCollection;
use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;

class MenuGroupRepository implements MenuGroupModelInterface
{
    /**
     * Create MenuGroup Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function create(array $data): MenuGroup
    {
        return MenuGroup::create($data);
    }

    /**
     * Find MenuGroup Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function find(int $id): MenuGroup
    {
        return MenuGroup::find($id);
    }

    /**
     * Delete MenuGroup Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return MenuGroup::destroy($id);
    }

    /**
     * Find MenuGroup Resource from data store.
     * @param string $identifier
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function getTreeByIdentifier(string $identifier) : SupportCollection
    {
        $menus = collect();
        $menuGroup = MenuGroup::whereIdentifier($identifier)->first();

        if ($menuGroup !== null) {
            $modelMenus = $menuGroup->menus()->whereNull('parent_id')->get();
            foreach ($modelMenus as $modelMenu) {
                $modelMenu->submenus;
                $menus->push($modelMenu);
            }
        }

        return $menus;
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $menuGroups
     */
    public function all() : Collection
    {
        return MenuGroup::all();
    }
}
