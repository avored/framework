<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Image\LocalFile;
use Illuminate\Database\Eloquent\Model;

class ProductDownloadableUrl extends Model
{
    protected $fillable = ['product_id', 'demo_path', 'main_path','token'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

}
