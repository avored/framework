<?php

namespace AvoRed\Framework\Models\Database;

class Language extends BaseModel
{
    protected $fillable = ['name', 'code', 'is_default'];
}
