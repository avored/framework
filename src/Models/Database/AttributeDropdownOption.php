<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class AttributeDropdownOption extends Model
{
    protected $fillable = ['attribute_id', 'display_text'];

    /**
     * Attribute Dropdown Options belongs to one Product Attribute.
     *
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
