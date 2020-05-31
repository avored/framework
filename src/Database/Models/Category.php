<?php

namespace AvoRed\Framework\Database\Models;

class Category extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'slug', 'meta_title', 'meta_description'];

    /**
     * Category belongs to many products.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
