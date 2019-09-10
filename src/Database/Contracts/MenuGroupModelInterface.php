<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\MenuGroup;
use Illuminate\Support\Collection as SupportCollection;

interface MenuGroupModelInterface
{
    /**
     * Create MenuGroup Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function create(array $data) : MenuGroup;

    /**
     * Find MenuGroup Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function find(int $id) : MenuGroup;

    /**
     * Get Menus Resource from data store.
     * @param string $identifier
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function getTreeByIdentifier(string $identifier) : SupportCollection;

    /**
     * Delete MenuGroup Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All MenuGroup from the database.
     * @return \Illuminate\Database\Eloquent\Collection $menuGroups
     */
    public function all() : Collection;
}
