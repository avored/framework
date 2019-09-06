<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'shipping_option',
        'payment_option',
        'order_status_id',
        'currency_id',
        'user_id',
        'shipping_address_id',
        'billing_address_id',
        'track_code',
    ];

    /**
     * Order Status.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * Order Status.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        $userClass = config('avored.model.user');

        return $this->belongsTo($userClass);
    }

    /**
     * Order Shipping Address.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    /**
     * Order Currency Model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Order Billing Address.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

    /**
     * Order Billing Address.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
