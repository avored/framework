<?php

namespace AvoRed\Framework\Database\Models;

use AvoRed\Framework\Database\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Collection;

class Property extends BaseModel
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
        'use_for_category_filter',
        'sort_order',
    ];

    /**
     * Appended attribute for the model.
     * @var array
     */
    //protected $appends = ['dropdown'];

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
        'TEXT' => 'Text Area (big text)',
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
        'SWITCH' => 'Switch',
    ];

    /**
     * Property has many varchar value.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Property has many dropdown options.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dropdownOptions()
    {
        return $this->hasMany(PropertyDropdownOption::class);
    }

    /**
     * Get the Dropdown Options for Select.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDropdownAttribute()
    {
        if ($this->field_type === 'SELECT' || $this->field_type === 'RADIO') {
            return $this->dropdownOptions()->remember()->get();
        }
    }

    /**
     * Get the Dropdown Options for Select.
     * @return \Illuminate\Support\Collection
     */
    public function getDropdownOptions(): Collection
    {
        $data = Collection::make([]);

        if ($this->dropdownOptions !== null && count($this->dropdownOptions) > 0) {
            foreach ($this->dropdownOptions as $dropdown) {
                $data->push([
                    'label' => $dropdown->display_text,
                    'value' => $dropdown->id,
                ]);
            }
        }

        return $data;
    }

}
