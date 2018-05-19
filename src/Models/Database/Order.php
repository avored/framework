<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'shipping_address_id',
        'billing_address_id',
        'user_id',
        'shipping_option',
        'payment_option',
        'order_status_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'qty', 'tax_amount');
    }

    public function orderProductVariation()
    {
        return $this->hasMany(OrderProductVariation::class, '');
    }

    public function user()
    {
        $userModel = config('avored-framework.model.user');
        return $this->belongsTo($userModel);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function getShippingAddressAttribute()
    {
        $addressClass = config('avored-framework.model.address');
        $addressModel = new $addressClass;
        $shippingAddress = $addressModel->findorfail($this->attributes['shipping_address_id']);

        return $shippingAddress;
    }

    public function getOrderStatusNameAttribute()
    {
        return $this->orderStatus->name;
    }

    public function getBillingAddressAttribute()
    {
        $addressClass   = config('avored-framework.model.address');
        $addressModel   = new $addressClass;
        $address        = $addressModel->findorfail($this->attributes['billing_address_id']);

        return $address;
    }
}
