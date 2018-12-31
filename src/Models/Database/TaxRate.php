<?php

namespace AvoRed\Framework\Models\Database;

class TaxRate extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'country_id',
        'state_id',
        'postcode',
        'rate'
    ];
}
