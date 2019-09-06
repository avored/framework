<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'identifier'];

    /**
     * Has Many Menus.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
