<?php

namespace AvoRed\Framework\Models\Database;

class AttributeTranslation extends BaseModel
{
    protected $fillable = [
        'attribute_id',
        'language_id',
        'name',
        'identifier'
    ];
}
