<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class ProductPropertyDatetimeValue extends Model
{
    protected $fillable = ['property_id', 'product_id', 'value'];

    protected $dates = ['created_at', 'updated_at', 'value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
