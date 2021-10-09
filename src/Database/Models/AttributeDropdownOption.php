<?php

namespace AvoRed\Framework\Database\Models;

class AttributeDropdownOption extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['attribute_id', 'display_text', 'path'];

    /**
     * Attribute dropdown option belongs to one attribute.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}