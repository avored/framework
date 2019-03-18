<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Models\Traits\TranslatedAttributes;

class AttributeDropdownOption extends BaseModel
{
    use TranslatedAttributes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['attribute_id', 'display_text'];

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
        return $this->hasMany(AttributeDropdownOptionTranslation::class);
    }
    /**
     * Attribute Dropdown Options belongs to one Product Attribute.
     *
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
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
