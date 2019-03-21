<?php

namespace AvoRed\Framework\Models\Database;

class PropertyTranslation extends BaseModel
{
    /**
     * Mass Assignable Property translation attributes
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'identifier',
        'property_id',
        'language_id'
    ];
}
