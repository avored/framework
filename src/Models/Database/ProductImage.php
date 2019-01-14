<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Image\LocalFile;

class ProductImage extends BaseModel
{
    /**
     * This resource can use only this fields from request object or data
     * @var $fillable
     */
    protected $fillable = ['product_id', 'path', 'is_main_image'];

    /**
     * Every image belogns to one product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo $product
     */
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get Path Attribute for the Image
     *
     * @param string $path
     * @return \AvoRed\Framework\Image\LocalFile $localImage
     */
    public function getPathAttribute($path)
    {
        if (null === $this->attributes['path'] || empty($this->attributes['path'])) {
            return;
        }

        $symlink = config('avored-framework.symlink_storage_folder');
        $relativePath = $this->attributes['path'];
        $localImage = new LocalFile($relativePath);

        return $localImage;
    }
}
