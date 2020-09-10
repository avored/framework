<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const CATEGORY = 'CATEGORY';
    const FRONT_MENU = 'FRONT_MENU';
    const CUSTOM = 'CUSTOM';

    const MENU_TYPE_OPTIONS = [
        self::CATEGORY => 'Category',
        self::FRONT_MENU => 'Front Menu',
        self::CUSTOM => 'Custom',
    ];
    
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'url', 'sort_order', 'menu_group_id', 'parent_id', 'type', 'route_info'];

    /**
     * Menu has many sub menus.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submenus()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
