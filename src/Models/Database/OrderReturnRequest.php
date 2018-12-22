<?php

namespace AvoRed\Framework\Models\Database;

class OrderReturnRequest extends BaseModel
{
    protected $fillable = ['order_id', 'status', 'comment'];

    /**
     * Get Order Model
     *
     * @return  Illuminate\Database\Eloquent\Relations\BelongsTo $order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get Collection of Products which is requested by user for return
     *
     * @return  Illuminate\Database\Eloquent\Relations\HasMany $products
     */
    public function products()
    {
        return $this->hasMany(OrderReturnProduct::class);
    }

    /**
     * Get Order Customer Full Name
     *
     * @return string $fullName
     */
    public function getCustomerNameAttribute()
    {
        return $this->order->user->full_name;
    }

    /**
     * Get Order Customer Phone Number
     *
     * @return string $phone
     */
    public function getCustomerPhoneAttribute()
    {
        return $this->order->user->phone;
    }
}
