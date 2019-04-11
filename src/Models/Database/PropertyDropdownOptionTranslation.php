<?php

namespace AvoRed\Framework\Models\Database;

class PropertyDropdownOptionTranslation extends BaseModel
{
    /**
     * The properties that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['property_dropdown_option_id', 'language_id', 'display_text'];

    /**
     * Property Dropdown Options Translation belongs to one  Property Dropdown Option.
     *
     * @return \AvoRed\Framework\Models\Database\PropertyDropdownOption
     */
    public function propertyDropdownOption()
    {
        return $this->belongsTo(PropertyDropdownOption::class);
    }
}
