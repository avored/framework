<?php

namespace AvoRed\Framework\Models\Database;

class OrderReturnProduct extends BaseModel
{
    protected $fillable = ['order_return_request_id', 'product_id', 'qty', 'reason'];

    /**
     * Get all of the owning commentable models.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
