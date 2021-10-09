<?php

namespace AvoRed\Framework\Database\Models;

class Configuration extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['code', 'value'];
}