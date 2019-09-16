<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'type',
        'amount',
        'active_from',
        'active_till'
    ];

    const TYPEOPTIONS = [
        'PERCENTAGE' => 'Percentage',
        'FIXED' => 'Fixed Amount',
        'FREE_SHIPPING' => 'Free Shipping'
    ];
}
