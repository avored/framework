<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = ['variation_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variationProduct()
    {
        return $this->belongsTo(Product::class, 'variation_id');
    }
}
