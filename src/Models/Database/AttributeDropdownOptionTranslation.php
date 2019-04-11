<?php

namespace AvoRed\Framework\Models\Database;

class AttributeDropdownOptionTranslation extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['attribute_dropdown_option_id', 'language_id', 'display_text'];

    /**
     * Attribute Dropdown Options Translation belongs to one  Attribute Dropdown Option.
     *
     * @return \AvoRed\Framework\Models\Database\AttributeDropdownOption
     */
    public function attributeDropdownOption()
    {
        return $this->belongsTo(AttributeDropdownOption::class);
    }
}
