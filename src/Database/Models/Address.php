<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'type',
        'customer_id',
        'company_name',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'postcode',
        'city',
        'state',
        'country_id',
        'phone',
    ];

    const SHIPPING = 'SHIPPING';
    const BILLING = 'BILLING';

    const TYPEOPTIONS = [
        self::SHIPPING => 'Shipping Address',
        self::BILLING => 'Billing Address',
    ];

    /**
     * Address Belongs to a Country Model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
