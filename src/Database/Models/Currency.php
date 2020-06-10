<?php

namespace AvoRed\Framework\Database\Models;

class Currency extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'conversation_rate',
        'status'
    ];
}
