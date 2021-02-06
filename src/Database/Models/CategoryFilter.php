<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryFilter extends Model
{
    /**
     * Category Filter Type Property.
     * @var string
     */
    public const PROPERTY_FILTER_TYPE = 'PROPERTY';

    /**
     * Category Filter Type Attribute.
     * @var string
     */
    public const ATTRIBUTE_FILTER_TYPE = 'ATTRIBUTE';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['category_id', 'filter_id', 'type'];

    /**
     * CategoryFilter belongs to one category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * CategoryFilter belongs to one category.
     * @return mixed $filterModel
     */
    public function getFilterAttribute()
    {
        if (self::PROPERTY_FILTER_TYPE === $this->type) {
            return Property::where('id', $this->filter_id)->remember()->get()->first();
        } else {
            return Attribute::where('id', $this->filter_id)->remember()->get()->first();
        }
    }
}
