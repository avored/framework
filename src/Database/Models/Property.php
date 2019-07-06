<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class Property extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'data_type',
        'field_type',
        'use_for_all_products',
        'is_visible_frontend',
        'use_for_category_filter',
        'sort_order'
    ];

    /**
     * Appended attribute for the model
     * @var array $appends
     */
    protected $appends =  ['dropdown'];

    /**
     * The available data types for the product property.
     * @var array
     */
    const PROPERTY_DATATYPES = [
        'INTEGER' => 'Integer',
        'DECIMAL' => 'Decimal',
        'DATETIME' => 'Date Time',
        'VARCHAR' => 'VarChar (max:255)',
        'BOOLEAN' => 'Boolean (true/false)',
        'TEXT' => 'Text Area (big text)'
    ];

    /**
     * The available field types for the product property.
     * @var array
     */
    const PROPERTY_FIELDTYPES = [
        'TEXT' => 'Text box',
        'TEXTAREA' => 'Text Area',
        'CKEDITOR' => 'Rich Text Editor',
        'SELECT' => 'Select (dropdown)',
        'FILE' => 'File',
        'DATETIME' => 'Date Time',
        'RADIO' => 'Radio',
        'SWITCH' => 'Switch'
    ];

    /**
     * Get the Dropdown Options for Select
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDropdownAttribute()
    {
        if ($this->field_type === 'SELECT' || $this->field_type === 'RADIO') {
            return $this->dropdownOptions;
        }

        
        return null;
    }

    /**
     * Get the Dropdown Options for Select
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDropdownOptions(): SupportCollection
    {
        $data = Collection::make([]);

        if ($this->dropdownOptions !== null && count($this->dropdownOptions) > 0) {
            foreach ($this->dropdownOptions as $dropdown) {
                $data->push([
                    'label' => $dropdown->display_text,
                    'value' => $dropdown->id
                ]);
            }
        }

        return $data;
    }
    
    /**
     * Get the Property Value based on its fields type
     * @return mixed $value
     */
    public function getPropertyValueByProductId(int $productId)
    {
        $val = null;
        switch ($this->field_type) {
            case 'SELECT':
            case 'RADIO':
                $val = $this->integerValues()->whereProductId($productId)->first() ?? null;
                break;

            case 'SWITCH':
                $this->booleanValues()->whereProductId($productId)->first() ?? null;
                break;

            case 'DATETIME':
                $this->datetimeValues()->whereProductId($productId)->first() ?? null;
                break;

            case 'TEXT':
                $this->varcharValues()->whereProductId($productId)->first() ?? null;
                break;

            case 'TEXTAREA':
                $this->textValues()->whereProductId($productId)->first() ?? null;
                break;

            default:
                throw new \Exception('there is an error while saving an product properties');
        }

        return $val;
    }

    /**
     * Store Product Property Values depend on field type
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param mixed $value
     * @return void
     */
    public function saveIntegerProperty(Product $product, int $value)
    {
        $intModel = $this->integerValues->first();

        if ($intModel !== null) {
            $intModel->update(['value' => $value]);
        } else {
            $this->integerValues()->create(
                ['product_id' => $product->id,
                'value' => $value]
            );
        }
    }

    /**
     * Store Product Property Values depend on field type
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param mixed $value
     * @return void
     */
    public function saveVarcharProperty(Product $product, string $value)
    {
        $model = $this->varcharValues->first();

        if ($model !== null) {
            $model->update(['value' => $value]);
        } else {
            $this->varcharValues()->create(
                ['product_id' => $product->id,
                'value' => $value]
            );
        }
    }

    /**
     * Store Product Property Values depend on field type
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param mixed $value
     * @return void
     */
    public function saveTextProperty(Product $product, string $value)
    {
        $model = $this->textValues->first();

        if ($model !== null) {
            $model->update(['value' => $value]);
        } else {
            $this->textValues()->create(
                ['product_id' => $product->id,
                'value' => $value]
            );
        }
    }

    /**
     * Store Product Property Values depend on field type
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param mixed $value
     * @return void
     */
    public function saveBooleanProperty(Product $product, string $value)
    {
        $model = $this->booleanValues->first();

        if ($model !== null) {
            $model->update(['value' => $value]);
        } else {
            $this->booleanValues()->create(
                ['product_id' => $product->id,
                'value' => $value]
            );
        }
    }

    /**
     * Store Product Property Values depend on field type
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param mixed $value
     * @return void
     */
    public function saveDatetimeProperty(Product $product, string $value)
    {
        $model = $this->datetimeValues->first();

        if ($model !== null) {
            $model->update(['value' => $value]);
        } else {
            $this->datetimeValues()->create(
                ['product_id' => $product->id,
                'value' => $value]
            );
        }
    }

    /**
     * Store Product Property Values depend on field type
     * @todo never used it yet
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param mixed $value
     * @return void
     */
    public function saveDecimalProperty(Product $product, float $value)
    {
        $model = $this->decimalValues->first();

        if ($model !== null) {
            $model->update(['value' => $value]);
        } else {
            $this->decimalValues()->create(
                ['product_id' => $product->id,
                'value' => $value]
            );
        }
    }

    /**
     * Property has many dropdown options
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dropdownOptions()
    {
        return $this->hasMany(PropertyDropdownOption::class);
    }

    /**
     * Property has many integer value
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function integerValues()
    {
        return $this->hasMany(ProductPropertyIntegerValue::class);
    }

    /**
     * Property has many varchar value
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function varcharValues()
    {
        return $this->hasMany(ProductPropertyVarcharValue::class);
    }

    /**
     * Property has many text value
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function textValues()
    {
        return $this->hasMany(ProductPropertyTextValue::class);
    }

    /**
     * Property has many boolean value
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function booleanValues()
    {
        return $this->hasMany(ProductPropertyBooleanValue::class);
    }

    /**
     * Property has many datetime value
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function datetimeValues()
    {
        return $this->hasMany(ProductPropertyDatetimeValue::class);
    }

    /**
     * Property has many decimal value
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function decimalValues()
    {
        return $this->hasMany(ProductPropertyDecimalValue::class);
    }
}
