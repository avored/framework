<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\MenuGroup;
use AvoRed\Framework\Models\Contracts\MenuGroupInterface;

class MenuGroupRepository implements MenuGroupInterface
{
    /**
     * Find an MenuGroup by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\MenuGroup
     */
    public function find($id)
    {
        return MenuGroup::find($id);
    }

    /**
     * Get all MenuGroup
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return MenuGroup::all();
    }

    /**
     * Get an MenuGroup Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return MenuGroup::query();
    }

    /**
     * Find an MenuGroup Query
     *
     * @return \AvoRed\Framework\Models\MenuGroup
     */
    public function create($data)
    {
        return MenuGroup::create($data);
    }
}
