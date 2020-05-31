<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\MenuGroup;
use Illuminate\Support\Collection as SupportCollection;
use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;

class MenuGroupRepository extends BaseRepository implements MenuGroupModelInterface
{
    /**
     * @var MenuGroup $model
     */
    protected $model;

    /**
     * Construct for the Attribute Repository
     */
    public function __construct()
    {
        $this->model = new MenuGroup();
    }

    /**
     * Get the model for the repository
     * @return MenuGroup 
     */
    public function model(): MenuGroup
    {
        return $this->model;
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
}
