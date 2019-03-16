<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use AvoRed\Framework\Models\Traits\TranslatedAttributes;

class Category extends BaseModel
{
    use TranslatedAttributes;
    
    protected $fillable = ['parent_id', 'name', 'slug', 'meta_title', 'meta_description'];

    /**
     * Category Model Attribute which can be translated
     * @var array $translatedAttributes 
     */
    protected $translatedAttributes = ['name', 'slug', 'meta_title', 'meta_description'];

    /**
     * Category Model Attribute which can be translated
     * @var string $translatedForeignKey
     */
    protected $translatedForeignKey = 'category_id';


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Category Model has many translation values 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    /**
     * Category Model Get Translation Model and return the value
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getTranslation($languageId = null)
    {
        $languageId = request()->get('language_id');
        if (null === $languageId) {
            return $this;
        } else {
            return $this->translations()->whereLanguageId($languageId)->first();
        }  
    }

    public static function getCategoryOptions()
    {
        $model = new static;
        $options = Collection::make(['' => 'Please Select'] + $model->all()->pluck('name', 'id')->toArray());

        return $options;
    }

    public function getParentNameAttribute()
    {
        $parentCategory = $this->where('id', '=', $this->attributes['parent_id'])->get()->first();

        return (null != $parentCategory) ? $parentCategory->name : '';
    }

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function categoryFilter()
    {
        return $this->hasMany(CategoryFilter::class);
    }

    /**
     * Get the Category Name
     * @return string $name
     */
    public function getName()
    {
        return $this->getAttribute('name', $translated = true);
    }

    /**
     * Get the Category Slug
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->getAttribute('slug', $translated = true);
    }
    /**
     * Get the Category Meta Title
     * @return string $metaTitle
     */
    public function getMetaTitle()
    {
        return $this->getAttribute('meta_title', $translated = true);
    }
    /**
     * Get the Category Meta Description
     * @return string $meta_description
     */
    public function getMetaDescription()
    {
        return $this->getAttribute('meta_description', $translated = true);
    }
}
