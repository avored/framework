<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

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
        'currency_code',
        'user_id',
        'shipping_address_id',
        'billing_address_id',
        'track_code'
    ];
}
