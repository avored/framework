<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends BaseModel
{
    use HasFactory;
    /**
     * The available display as enum options.
     * @var array
     */
    public const DISPLAY_AS = [
        'IMAGE' => 'Image',
        'TEXT' => 'Text',
    ];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'slug', 'display_as'];

    /**
     * Appended attribute for the model.
     * @var
     */
    protected $appends = ['dropdown'];

    /**
     * Attribute has many dropdown options.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dropdownOptions()
    {
        return $this->hasMany(AttributeDropdownOption::class);
    }

    /**
     * Attribute Belongs to many Products.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Get the Dropdown Options for Select.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDropdownAttribute()
    {
        return $this->dropdownOptions;
    }
}
