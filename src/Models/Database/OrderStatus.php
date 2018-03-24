<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['name', 'is_default'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
