<?php

namespace AvoRed\Framework\Models\Database;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BlogCategory extends BaseModel
{

    use Sluggable;

    protected $fillable = ['parent_id', 'name', 'slug', 'meta_title', 'meta_description'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

}
