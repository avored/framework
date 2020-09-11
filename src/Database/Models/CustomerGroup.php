<?php

namespace AvoRed\Framework\Database\Models;

class CustomerGroup extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'is_default'];
}
