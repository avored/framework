<?php

namespace AvoRed\Framework\Models\Database;

class OrderHistory extends BaseModel
{
    protected $fillable = ['order_id', 'order_status_id'];

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
