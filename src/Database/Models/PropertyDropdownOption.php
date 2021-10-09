<?php

namespace AvoRed\Framework\Database\Models;

class PropertyDropdownOption extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['property_id', 'display_text'];
}
