<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Image\LocalFile;

class ProductImage extends BaseModel
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
        $symlink = config('avored-framework.symlink_storage_folder');
        $relativePath =  $symlink . DIRECTORY_SEPARATOR .$this->attributes['path'];
        $localImage = new LocalFile($relativePath);

        return $localImage;
    }
}
