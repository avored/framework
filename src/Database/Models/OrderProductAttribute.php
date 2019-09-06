<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductAttribute extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'order_product_id',
        'attribute_id',
        'attribute_dropdown_option_id',
    ];

    /**
     * Order Product belongs to one order.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
