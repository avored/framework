<?php

namespace AvoRed\Framework\Models\Database;

class MenuGroup extends BaseModel
{
    protected $fillable = ['name', 'identifier'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
