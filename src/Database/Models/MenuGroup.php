<?php

namespace AvoRed\Framework\Database\Models;

class MenuGroup extends BaseModel
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
