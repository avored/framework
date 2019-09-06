<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'url', 'sort_order', 'menu_group_id', 'parent_id'];

    /**
     * Menu has many sub menus.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submenus()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
