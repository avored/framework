<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Models\Traits\TranslatedAttributes;

class PropertyDropdownOption extends BaseModel
{
    use TranslatedAttributes;

    protected $fillable = ['property_id', 'display_text'];

    /**
     * The attributes that are translatable assignable.
     *
     * @var array
    */
    protected $translatedAttributes = ['display_text'];

    /**
     * Attribute Translation Model has many translation values 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(PropertyDropdownOptionTranslation::class);
    }

    /**
     * Proerty Dropdown Options belongs to one Product Property.
     *
     * @return \AvoRed\Framework\Models\Database\Property
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }


    /**
     * Get display text  of an attribute dropdown option
     *
     * @return string $displayText
     */
    public function getDisplayText()
    {
        return $this->getAttribute('display_text', $translated = true);
    }
}
