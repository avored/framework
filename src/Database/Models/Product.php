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
     * Get the Price of the Product.
     * @param bool $format
     * @return float $price
     */
    public function getPrice($format = true)
    {
        $price = $this->price;
        if ($format) {
            return number_format($price, 2);
        }

        return $price;
    }

    /**
     * Get the Qty of the product.
     * @return mixex $qty
     */
    public function getQty()
    {
        $qty = $this->qty;
        if ($qty <= 0) {
            return __('avored::catalog.product.not_available_in_stock');
        }

        return __('avored::catalog.product.available_in_stock', ['qty' => number_format($qty, 0)]);
    }

    /**
     * Get the Tax Amount of the product.
     * @return mixex $taxAmount
     */
    public function getTaxAmount()
    {
        $configurationRepository = app(ConfigurationModelInterface::class);
        $taxPercentage = $configurationRepository->getValueByCode(self::TAX_CONFIGURATION_KEY) ?? 0;

        return $this->getPrice(false) * $taxPercentage / 100;
    }

    /**
     * Belongs to Many Product Images.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    /**
     * Has one Product Images.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->whereIsMainImage(true);
    }

    /**
     * Get Main Image Url.
     * @return string $mainImageUrl
     */
    public function getMainImageUrlAttribute(): string
    {
        $defaultImage = 'https://placehold.it/250x250';
        $image = $this->images()->whereIsMainImage(true)->first();
        if ($image === null) {
            return $defaultImage;
        }

        return asset('storage/'. $image->path);
    }

    /**
     * Get Attribute by given attribute Id.
     * @return \AvoRed\Framework\Database\Models\Attribute $attribute
     */
    public function getAttributeById($attributeId): Attribute
    {
        return Attribute::find($attributeId);
    }

    /**
     * Get Variation Groups to display variation of a product.
     * @return \Illuminate\Database\Eloquent\Collection $variations
     */
    public function getVariationByAttributeGroup()
    {
        $variations = Collection::make([]);
        $productAttributeValues = $this->attributeProductValues;

        foreach ($productAttributeValues as $productAttributeValue) {
            $productAttributeValue->variation;
            if ($variations->has($productAttributeValue->attribute_id)) {
                $existing = $variations->get($productAttributeValue->attribute_id);
                $existing[] = $productAttributeValue;
                $variations->put($productAttributeValue->attribute_id, $existing);
            } else {
                $variations->put($productAttributeValue->attribute_id, [$productAttributeValue]);
            }
        }

        return $variations;
    }

    /**
     * Get Variation Groups to display variation of a product.
     * @return \Illuminate\Database\Eloquent\Collection $variations
     */
    public function getVariations()
    {
        $data = Collection::make([]);
        $productAttributeValues = $this->attributeProductValues;

        foreach ($productAttributeValues as $productAttributeValue) {
            $productAttributeValue->attributeDropdownOption;
            $productAttributeValue->variation;
            $productAttributeValue->variation->images;
            $data->push($productAttributeValue);
        }
        $variations = $data->groupBy('variation_id');

        return $variations;
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
     * Product has many Product Interger Property Values.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributeProductValues()
    {
        return $this->hasMany(AttributeProductValue::class);
    }

    /**
     * Product has many Product Interger Property Values.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyIntegerValues()
    {
        return $this->hasMany(ProductPropertyIntegerValue::class);
    }

    /**
     * Product has many Product Varchar Property Values.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyVarcharValues()
    {
        return $this->hasMany(ProductPropertyVarcharValue::class);
    }

    /**
     * Product has many Product Decimal Property Values.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyDecimalValues()
    {
        return $this->hasMany(ProductPropertyDecimalValue::class);
    }

    /**
     * Product has many Product Text Property Values.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyTextValues()
    {
        return $this->hasMany(ProductPropertyTextValue::class);
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
     * Product has many Product Boolean Property Values.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyBooleanValues()
    {
        return $this->hasMany(ProductPropertyBooleanValue::class);
    }

    /**
     * Product has many Product Date Time Property Values.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPropertyDatetimeValues()
    {
        return $this->hasMany(ProductPropertyDatetimeValue::class);
    }

    /**
     * Get to Many Properties.
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
