<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;

class Product extends BaseModel
{
    /**
     * Tax Percentage Configuration Constant.
     * @var string
     */
    const TAX_CONFIGURATION_KEY = 'tax_percentage';
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
        'meta_description',
    ];

    /**
     * Product Types.
     * @var array
     */
    const PRODUCT_TYPES = [
        self::PRODUCT_TYPES_BASIC => 'Basic',
        self::PRODUCT_TYPES_DOWNLOADABLE => 'Downlodable',
        self::PRODUCT_TYPES_VARIABLE_PRODUCT => 'Variable Product',
    ];

    const PRODUCT_TYPES_BASIC = 'BASIC';
    const PRODUCT_TYPES_DOWNLOADABLE = 'DOWNLOADABLE';
    const PRODUCT_TYPES_VARIABLE_PRODUCT = 'VARIABLE_PRODUCT';
    const PRODUCT_TYPES_VARIATION = 'VARIATION';

    /**
     * Belongs to Many Categories.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    /**
     * Belongs to Many Properties.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    /**
     * Product has many Product Text Property Values.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutVariation($query)
    {
        return $query->where('type', '!=', self::PRODUCT_TYPES_VARIATION);
    }
}
