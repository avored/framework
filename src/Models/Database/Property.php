<?php

namespace AvoRed\Framework\Models\Database;

class Property extends BaseModel
{
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
        $method = $this->getPropertyDataTable();
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
     * Return data relationship
     * @return string
     */
    public function getPropertyDataTable()
    {
        $dataType = ucfirst(strtolower($this->data_type));
        $method = 'productProperty' . $dataType . 'Value';
        return $method;
    }

    public function getProductRelationship()
    {
        $dataType = ucfirst(strtolower($this->data_type));
        $method = 'product' . $dataType . 'Properties';
        return $method;
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
}
