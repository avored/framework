<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'product_id',
        'path',
        'alt_text',
        'is_main_image',
    ];

    /**
     * Belongs to Many Product.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
