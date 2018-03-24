<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class OrderProductVariation extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'attribute_dropdown_option_id',
        'attribute_id',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributeDropdownOption()
    {
        return $this->belongsTo(AttributeDropdownOption::class);
    }
}
