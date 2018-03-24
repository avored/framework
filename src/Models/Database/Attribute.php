<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name', 'identifier']; //, 'data_type','field_type' ,'sort_order'];

    public function attributeDropdownOptions()
    {
        return $this->hasMany(AttributeDropdownOption::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
