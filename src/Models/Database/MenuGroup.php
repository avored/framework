<?php

namespace AvoRed\Framework\Models\Database;

class MenuGroup extends BaseModel
{
    protected $fillable = ['name', 'identifier', 'is_default'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
