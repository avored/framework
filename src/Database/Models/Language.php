<?php

namespace AvoRed\Framework\Database\Models;

class Language extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'is_default'
    ];
}
