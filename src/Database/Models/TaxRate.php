<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'description', 'rate', 'country_id', 'postcode', 'rate_type'];

    /**
     * Tax Rate Type.
     * @var array
     */
    const RATE_TYPE_OPTIONS = [
        'PERCENTAGE' => 'Percentage',
        'FIXED' => 'Fixed Rate',
    ];
}
