<?php

namespace AvoRed\Framework\Models\Database;

class UserGroup extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_default'
    ];

}
