<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeProductValue extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['attribute_id', 'product_id', 'variation_id', 'attribute_dropdown_option_id'];

    /**
     * Attribute product value belongs to a attribute dropdown option.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attributeDropdownOption()
    {
        return $this->belongsTo(AttributeDropdownOption::class);
    }

    /**
     * Attribute product value belongs to a attribute.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * Product Variation Model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variation()
    {
        return $this->belongsTo(Product::class, 'variation_id');
    }
}
