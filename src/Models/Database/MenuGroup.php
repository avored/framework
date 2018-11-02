<?php

namespace AvoRed\Framework\Models\Database;

class MenuGroup extends BaseModel
{
    protected $fillable = ['name', 'identifier'];

    public function children()
    {
        return $this->whereParentId($this->attributes['id'])->get();
    }
}
