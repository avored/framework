<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Contracts\MenuModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class MenuRepository extends BaseRepository implements MenuModelInterface
{
    /**
     * @var Menu $model
     */
    protected $model;

    /**
     * Construct for the Attribute Repository
     */
    public function __construct()
    {
        $this->model = new Menu();
    }

    /**
     * Get the model for the repository
     * @return Menu 
     */
    public function model(): Menu
    {
        return $this->model;
    }
}
