<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryFilter extends Model
{
    protected $fillable = ['category_id', 'type', 'filter_id'];

}
