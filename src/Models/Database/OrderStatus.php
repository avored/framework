<?php

namespace AvoRed\Framework\Models\Database;

class OrderStatus extends BaseModel
{
    protected $fillable = ['name', 'is_default'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
