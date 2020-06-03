<?php

namespace AvoRed\Framework\Database\Models;

class OrderProduct extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'product_id',
        'order_id',
        'qty',
        'price',
        'tax_amount',
    ];

    /**
     * Order Product belongs to one order.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Order Product belongs to one Product.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
