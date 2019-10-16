<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    protected $dates = [
        'active_from',
        'active_till',
        'created_at',
        'updated_at'
    ];

    const TYPEOPTIONS = [
        'PERCENTAGE' => 'Percentage',
        'FIXED' => 'Fixed Amount',
        'FREE_SHIPPING' => 'Free Shipping'
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
