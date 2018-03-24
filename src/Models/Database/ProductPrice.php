<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $fillable = ['product_id', 'price'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
