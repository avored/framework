<?php

namespace AvoRed\Framework\Models\Database;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BlogPost extends BaseModel
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'content'
    ];

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

    public function category()
    {
        return $this->belongsToMany(BlogCategory::class);
    }

}
