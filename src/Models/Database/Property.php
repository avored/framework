<?php
namespace AvoRed\Framework\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['name', 'identifier', 'data_type','field_type' ,'sort_order'];


    public function propertyDropdownOptions() {
        return $this->hasMany(PropertyDropdownOption::class);
    }

}


