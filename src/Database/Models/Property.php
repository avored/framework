<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

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
        'sort_order'
    ];

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
        'CHECKBOX' => 'Checkbox',
        'SWITCH' => 'Switch'
    ];

    /**
     * Property has many dropdown options
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dropdownOptions()
    {
        return $this->hasMany(PropertyDropdownOption::class);
    }

    /**
     * Get the Dropdown Options for Select
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDropdownAttribute()
    {
        if ($this->field_type === 'SELECT') {
            return $this->dropdownOptions;
        }

        return null;
    }
}
