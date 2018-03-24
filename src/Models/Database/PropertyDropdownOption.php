<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class PropertyDropdownOption extends Model
{
    protected $fillable = ['property_id', 'display_text'];

    /**
     * Proerty Dropdown Options belongs to one Product Property.
     *
     * @return \AvoRed\Framework\Models\Database\Property
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
