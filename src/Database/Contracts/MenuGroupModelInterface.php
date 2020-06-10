<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\MenuGroup;
use Illuminate\Support\Collection as SupportCollection;

interface MenuGroupModelInterface extends BaseInterface
{
    /**
     * Get Menus Resource from data store.
     * @param string $identifier
     * @return \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     */
    public function getTreeByIdentifier(string $identifier) : SupportCollection;
}
