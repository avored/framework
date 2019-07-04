<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'type',
        'sku',
        'barcode',
        'description',
        'status',
        'in_stock',
        'track_stock',
        'qty',
        'is_taxable',
        'price',
        'cost_price',
        'weight',
        'height',
        'width',
        'length',
        'meta_title',
        'meta_description'
    ];

    /**
     * Product Types
     * @var array
     */
    const PRODUCT_TYPES = [
        'BASIC' => 'Basic',
        'DOWNLOADABLE' => 'Downlodable',
        'VARIABLE_PRODUCT' => 'Variable Product'
    ];

    /**
     * Belongs to Many Categories
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Belongs to Many Product Images
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    /**
     * Get Main Image Url
     * @return string $mainImageUrl
     */
    public function getMainImageUrlAttribute(): string
    {
        $defaultImage = 'https://placehold.it/250x250';
        $image = $this->images()->whereIsMainImage(true)->first();
        if ($image === null) {
            return $defaultImage;
        }
        return asset('storage/' . $image->path);
    }

    /**
     * Belongs to Many Properties
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}
