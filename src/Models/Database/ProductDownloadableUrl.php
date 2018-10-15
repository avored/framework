<?php

namespace AvoRed\Framework\Models\Database;

class ProductDownloadableUrl extends BaseModel
{
    protected $fillable = ['product_id', 'demo_path', 'main_path', 'token'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
