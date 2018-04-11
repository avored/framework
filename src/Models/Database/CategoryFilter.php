<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryFilter extends Model
{
    protected $fillable = ['category_id', 'type', 'filter_id'];


    public function category() {
        return $this->hasMany(Category::class);
    }

    public function getModelAttribute() {

        if($this->attributes['type'] == "ATTRIBUTE") {
            return Attribute::find($this->attributes['filter_id']);
        }
        if($this->attributes['type'] == "PROPERTY") {
            return Property::find($this->attributes['filter_id']);
        }

    }
}
