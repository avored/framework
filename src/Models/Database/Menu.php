<?php

namespace AvoRed\Framework\Models\Database;

class Menu extends BaseModel
{
    protected $fillable = ['name', 'route', 'params', 'parent_id', 'menu_group_id'];

    public function children()
    {
        return $this->whereParentId($this->attributes['id'])->get();
    }
}
