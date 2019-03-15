<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AttributeTranslation extends BaseModel
{
    protected $fillable = [
        'attribute',
        'language_id',
        'name'
    ];
}
