<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['code', 'value'];

    const ENABLED = 'ENABLED';
    const DISABLED = 'DISABLED';

    const BOOLEAN_OPTIONS = [
        self::ENABLED => 'Enabled',
        self::DISABLED => 'DISABLED'
    ];
}
