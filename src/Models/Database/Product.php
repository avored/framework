<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Models\Database\Traits\ProductAttribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class Product extends BaseModel
{
    use Sluggable, ProductAttribute;

    public static $VARIATION_TYPE = 'VARIATION';

    protected $fillable = [
        'type', 'name', 'slug', 'sku',
        'description', 'status', 'in_stock', 'track_stock', 'price', 'regular_price', 'cost_price',
        'qty', 'is_taxable', 'meta_title', 'meta_description',
        'weight', 'width', 'height', 'length',
    ];

    public static function getProductBySlug($slug)
    {
        $model = new static;

        return $model->where('slug', '=', $slug)->first();
    }

    public static function boot()
    {
        parent::boot();
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Product has many Categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Product has many Categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    /**
     * Product has many Image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Product has many Variation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * Product has many Integer Attribute.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productIntegerAttributes()
    {
        return $this->hasMany(ProductAttributeIntegerValue::class);
    }

    /**
     * Product has many Date Time Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productVarcharProperties()
    {
        return $this->hasMany(ProductPropertyVarcharValue::class);
    }

    /**
     * Product has many Date Time Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDatetimeProperties()
    {
        return $this->hasMany(ProductPropertyDatetimeValue::class);
    }

    /**
     * Product has many Boolean Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productBooleanProperties()
    {
        return $this->hasMany(ProductPropertyBooleanValue::class);
    }

    /**
     * Product has many Integer Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productIntegerProperties()
    {
        return $this->hasMany(ProductPropertyIntegerValue::class);
    }

    /**
     * Product has many Text Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productTextProperties()
    {
        return $this->hasMany(ProductPropertyTextValue::class);
    }

    /**
     * Product has many Decimal Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDecimalProperties()
    {
        return $this->hasMany(ProductPropertyDecimalValue::class);
    }

    /**
     * Product has many Attribute.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attribute()
    {
        return $this->belongsToMany(Attribute::class);
    }

    /**
     * Product has many Order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Product has downladable Url.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function downloadable()
    {
        return $this->hasOne(ProductDownloadableUrl::class);
    }
}
