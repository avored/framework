<?php

namespace AvoRed\Framework\Database\Models;

class Category extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'parent_id'
    ];

    /**
     * Category belongs to many products.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
      
    /**
     * Category can has many child categories.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Category can have one parent category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
