<?php

namespace AvoRed\Framework\Models\Database;

class SiteCurrency extends BaseModel
{
    protected $fillable = ['code', 'name', 'conversion_rate', 'status', 'symbol'];
}
