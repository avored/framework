<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['name', 'identifier', 'data_type', 'field_type', 'sort_order'];

    public function propertyDropdownOptions()
    {
        return $this->hasMany(PropertyDropdownOption::class);
    }

    /**
     * Save Product Property based on its data_type.
     *
     * @return void
     */
    public function saveProperty($productId, $propertyValue)
    {
        if ($this->data_type == 'VARCHAR') {
            $propertyVarcharValue = ProductPropertyVarcharValue::
                                            whereProductId($productId)
                                            ->wherePropertyId($this->id)->first();

            if (null === $propertyVarcharValue) {
                ProductPropertyVarcharValue::create([
                    'product_id' => $productId,
                    'property_id' => $this->id,
                    'value' => $propertyValue,
                ]);
            } else {
                $propertyVarcharValue->update(['value' => $propertyValue]);
            }
        }

        if ($this->data_type == 'BOOLEAN') {
            $propertyBooleanValue = ProductPropertyBooleanValue::
                                            whereProductId($productId)
                                            ->wherePropertyId($this->id)->first();

            if (null === $propertyBooleanValue) {
                ProductPropertyBooleanValue::create([
                    'product_id' => $productId,
                    'property_id' => $this->id,
                    'value' => $propertyValue,
                ]);
            } else {
                $propertyBooleanValue->update(['value' => $propertyValue]);
            }
        }

        if ($this->data_type == 'TEXT') {
            $propertyTextValue = ProductPropertyTextValue::
                                            whereProductId($productId)
                                            ->wherePropertyId($this->id)->get()->first();

            if (null === $propertyTextValue) {
                ProductPropertyTextValue::create([
                    'product_id' => $productId,
                    'property_id' => $this->id,
                    'value' => $propertyValue,
                ]);
            } else {
                $propertyTextValue->update(['value' => $propertyValue]);
            }
        }

        if ($this->data_type == 'DECIMAL') {
            $propertyDecimalValue = ProductPropertyDecimalValue::
                                                whereProductId($productId)
                                                ->wherePropertyId($this->id)->first();

            if (null === $propertyDecimalValue) {
                ProductPropertyDecimalValue::create([
                    'product_id' => $productId,
                    'property_id' => $this->id,
                    'value' => $propertyValue,
                ]);
            } else {
                $propertyDecimalValue->update(['value' => $propertyValue]);
            }
        }

        if ($this->data_type == 'INTEGER') {
            $propertyIntegerValue = ProductPropertyIntegerValue::
                                                whereProductId($productId)
                                                ->wherePropertyId($this->id)->get()->first();

            if (null === $propertyIntegerValue) {
                ProductPropertyIntegerValue::create([
                    'product_id' => $productId,
                    'property_id' => $this->id,
                    'value' => $propertyValue,
                ]);
            } else {
                $propertyIntegerValue->update(['value' => $propertyValue]);
            }
        }

        if ($this->data_type == 'DATETIME') {
            $propertyDatetimeValue = ProductPropertyDatetimeValue::
                                                whereProductId($productId)
                                                ->wherePropertyId($this->id)->get()->first();

            if (null === $propertyDatetimeValue) {
                ProductPropertyDatetimeValue::create([
                    'product_id' => $productId,
                    'property_id' => $this->id,
                    'value' => $propertyValue,
                ]);
            } else {
                $propertyDatetimeValue->update(['value' => $propertyValue]);
            }
        }
    }
}
