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
     * Belongs to Many Product Images
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id');
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

    /**
     * Product has many Product Interger Property Values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributeProductValues()
    {
        return $this->hasMany(AttributeProductValue::class);
    }

    /**
     * Product has many Product Interger Property Values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyIntegerValues()
    {
        return $this->hasMany(ProductPropertyIntegerValue::class);
    }

    /**
     * Product has many Product Varchar Property Values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyVarcharValues()
    {
        return $this->hasMany(ProductPropertyVarcharValue::class);
    }
    /**
     * Product has many Product Decimal Property Values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyDecimalValues()
    {
        return $this->hasMany(ProductPropertyDecimalValue::class);
    }
   
    /**
     * Product has many Product Text Property Values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyTextValues()
    {
        return $this->hasMany(ProductPropertyTextValue::class);
    }

    /**
     * Product has many Product Text Property Values
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    /**
     * Product has many Product Boolean Property Values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyBooleanValues()
    {
        return $this->hasMany(ProductPropertyBooleanValue::class);
    }
    
    /**
     * Product has many Product Date Time Property Values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyDatetimeValues()
    {
        return $this->hasMany(ProductPropertyDatetimeValue::class);
    }

    /**
     * Get to Many Properties
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProperties()
    {
        $properties = $this->properties;

        foreach ($properties as $property) {
            $property->product_value = $property->getPropertyValueByProductId($this->id);
        }

        return $properties;
    }
}
