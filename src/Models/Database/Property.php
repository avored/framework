<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Models\Traits\TranslatedAttributes;

class Property extends BaseModel
{
    use TranslatedAttributes;
    /**
     * Mass Assignable Property translation attributes
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'identifier',
        'data_type',
        'field_type',
        'sort_order',
        'is_visible_frontend',
        'use_for_all_products'
    ];

    /**
     * The attributes that are translatable assignable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name', 'identifier'];

    /**
     * Attribute Model has many translation values 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function translations()
    {
        return $this->hasMany(PropertyTranslation::class);
    }

    /**
     * Get the Select Property Dropdown options collection.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function propertyDropdownOptions()
    {
        return $this->hasMany(PropertyDropdownOption::class);
    }

    /**
     * Get the Property Boolean Value of a given Product.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function productPropertyBooleanValue()
    {
        return $this->hasMany(ProductPropertyBooleanValue::class);
    }

    /**
     * Get the Property Date Time Value of a given Product.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function productPropertyDatetimeValue()
    {
        return $this->hasMany(ProductPropertyDatetimeValue::class);
    }

    /**
     * Get the Property Decimal Value of a given Product.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function productPropertyDecimalValue()
    {
        return $this->hasMany(ProductPropertyDecimalValue::class);
    }

    /**
     * Get the Property Integer Value of a given Product.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function productPropertyIntegerValue()
    {
        return $this->hasMany(ProductPropertyIntegerValue::class);
    }

    /**
     * Get the Property Text Value of a given Product.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function productPropertyTextValue()
    {
        return $this->hasMany(ProductPropertyTextValue::class);
    }

    /**
     * Get the Property Varchar Value of a given Product.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function productPropertyVarcharValue()
    {
        return $this->hasMany(ProductPropertyVarcharValue::class);
    }

    /**
     * Attach  Product to a Property Model.
     *
     * @param \AvoRed\Framework\Models\Database\Product $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function attachProduct($model)
    {
        $valueModel = $this->getProductValueModel($model->id);

        return $valueModel;
    }

    /**
     * Get Product Property Value Model based by ProductID.
     *
     * @param integer $productId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getProductValueModel($productId)
    {
        $dataType = ucfirst(strtolower($this->data_type));

        $method = 'productProperty' . $dataType . 'Value';

        $productPropertyModel = $this
                                        ->$method()
                                        ->whereProductId($productId)
                                        ->get();

        if ($productPropertyModel->count() == 0) {
            $valueClass = __NAMESPACE__ . '\\' . ucfirst($method);

            $valueModel = new $valueClass([
                'property_id' => $this->id,
                'product_id' => $productId
            ]);
        } else {
            $valueModel = $this->$method()->whereProductId($productId)->first();
        }

        return $valueModel;
    }

    /**
     * Property belongs to many Products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Get the name of the Attribute
     * @return string $name
     */
    public function getName()
    {
        return $this->getAttribute('name', $translated = true);
    }

    /**
     * Get the identifier of the Attribute
     * @return string $name
     */
    public function getIdentifier()
    {
        return $this->getAttribute('identifier', $translated = true);
    }
}
