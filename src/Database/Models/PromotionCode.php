<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Support\Carbon;

class PromotionCode extends BaseModel
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

    protected $dates = [
        'active_from',
        'active_till',
        'created_at',
        'updated_at'
    ];

    const PERCENTAGE = 'PERCENTAGE';
    const FIXED = 'FIXED';

    const TYPEOPTIONS = [
        self::PERCENTAGE => 'Percentage',
        self::FIXED => 'Fixed Amount',
        // 'FREE_SHIPPING' => 'Free Shipping' 
        
        // Needs To think about 
        // If this is active then how does shipping option works in checkout page
    ];

    public function scopeStatus($query, $value = 1)
    {
        return $query->where('status', $value);
    }

    public function scopeActiveFrom($query)
    {
        $value = Carbon::now();
        return $query->where('active_from', '<=', $value);
    }

    public function scopeActiveTill($query)
    {
        $value = Carbon::now();
        return $query->where('active_till', '>=', $value);
    }
}
