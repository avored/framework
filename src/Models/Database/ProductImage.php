<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Image\LocalFile;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'path', 'is_main_image'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPathAttribute()
    {
        if (null === $this->attributes['path'] || empty($this->attributes['path'])) {
            return;
        }
        $localImage = new LocalFile($this->attributes['path']);

        return $localImage;
    }
}
