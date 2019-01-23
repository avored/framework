<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\Menu;
use AvoRed\Framework\Models\Contracts\MenuInterface;

class MenuRepository implements MenuInterface
{
    /**
     * Find an Menu by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Menu
     */
    public function find($id)
    {
        return Menu::find($id);
    }

    /**
     * Get Collection for All Parents Menu
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function parentsAll()
    {
        return Menu::whereParentId(null)->orWhere('parent_id', '=', 0)->get();
    }

    /**
     * Get all Menu
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Menu::all();
    }

    /**
     * Paginate Menu
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Menu::paginate($noOfItem);
    }

    /**
     * Get an Menu Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Menu::query();
    }

    /**
     * Find an Menu Query
     *
     * @return \AvoRed\Framework\Models\Menu
     */
    public function create($data)
    {
        return Menu::create($data);
    }

    /**
     *
     * @param array $menus
     * @param \AvoRed\Framework\Models\Database\MenuGroup $menuGroup
     * @return \AvoRed\Framework\Models\Repository\MenuRepository
     */
    public function truncateAndCreateMenus($menuGroup, $menus)
    {
        $menuGroup->menus()->delete();
        if (!count($menus)) {
            return;
        }
        foreach ($menus as $menu) {
            $this->_saveMenu($menuGroup, $menu);
        }
    }

    private function _saveMenu($menuGroup, $menus, $parentId = null)
    {
        foreach ($menus as $menu) {
            if (isset($menu->name)) {
                $menuModel = $this->create([
                    'menu_group_id' => $menuGroup->id,
                    'name' => $menu->name,
                    'route' => $menu->route,
                    'params' => $menu->params,
                    'parent_id' => $parentId
                ]);
            }

            if (isset($menu->children) && count($menu->children[0]) > 0) {
                $this->_saveMenu($menuGroup, $menu->children[0], $menuModel->id);
            }
        }
    }
}
