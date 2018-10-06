<?php

namespace AvoRed\Framework\Models\Database;

class OrderReturnRequest extends BaseModel
{
    protected $fillable = ['order_id', 'status',  'comment'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function products()
    {
        return $this->hasMany(OrderReturnProduct::class);
    }
}
