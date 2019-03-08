<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryTranslation extends BaseModel
{
    protected $fillable = [
        'category_id',
        'language_id',
        'name', 'slug',
        'meta_title',
        'meta_description'
    ];
}
