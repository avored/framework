<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PageTranslation extends BaseModel
{
    protected $fillable = [
        'page_id',
        'language_id',
        'name',
        'slug',
        'content',
        'meta_title',
        'meta_description'
    ];
}
