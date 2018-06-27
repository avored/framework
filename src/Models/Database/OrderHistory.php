<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
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
