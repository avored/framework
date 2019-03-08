<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Category extends BaseModel
{
    protected $fillable = ['parent_id', 'name', 'slug', 'meta_title', 'meta_description'];

    /**
     * Category Model Attribute which can be translated
     * @var array $translatedAttributes 
     */
    protected $translatedAttributes = ['name', 'slug', 'meta_title', 'meta_description'];


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

    /*
    * Return Products of Category with Filters
    *
    *
    * @param array   $filters

    public function getCategoryProductWithFilter($filters = [])
    {
        $prefix = config('database.connections.mysql.prefix');

        $propetryInnerJoinFlag = false;
        $attributeInnerJoinFlag = false;

        $sql = "Select p.id
                FROM {$prefix}products as p
                INNER JOIN {$prefix}category_product as cp on p.id = cp.product_id ";

        foreach ($filters as $type => $filterArray) {
            if ('property' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $property = Property::whereIdentifier($identifier)->first();

                    if ('INTEGER' == $property->data_type) {
                        if (false === $propetryInnerJoinFlag) {
                            $propetryInnerJoinFlag = true;
                            $sql .= "INNER JOIN {$prefix}product_property_integer_values as ppiv ON p.id = ppiv.product_id ";
                        }
                    }
                }
            }

            if ('attribute' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $attribute = Attribute::whereIdentifier($identifier)->first();
                    if (false === $attributeInnerJoinFlag) {
                        $attributeInnerJoinFlag = true;
                        $sql .= "INNER JOIN {$prefix}product_attribute_integer_values as paiv ON p.id = paiv.product_id ";
                    }
                }
            }
        }

        $sql .= "WHERE p.type != 'VARIABLE_PRODUCT' AND  cp.category_id = ? ";

        foreach ($filters as $type => $filterArray) {
            if ('property' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $property = Property::whereIdentifier($identifier)->first();

                    if ('INTEGER' == $property->data_type) {
                        $sql .= "AND ppiv.property_id = {$property->id} AND ppiv.value={$value} ";
                    }
                }
            }
        }

        foreach ($filters as $type => $filterArray) {
            if ('attribute' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $attribute = Attribute::whereIdentifier($identifier)->first();
                    $sql .= "AND paiv.attribute_id = {$attribute->id} AND paiv.value={$value} ";
                }
            }
        }

        $products = DB::select($sql, [$this->id]);
        $collect = Collection::make([]);

        foreach ($products as $productArray) {
            $product = Product::find($productArray->id);

            if ($product->type == 'VARIABLE_PRODUCT') {
                $collect->push(($product->getVariableMainProduct()));
            } else {
                $collect->push(Product::find($productArray->id));
            }
        }

        return $collect;
    }
     */

    /*
     public function getFilters()
    {
        $attrs = Collection::make([]);
        $productIds = Collection::make([]);
        $collections = Collection::make([]);

        $products = $this->products;

        foreach ($products as $product) {
            foreach ($product->productVariations as $variation) {
                $productIds->push($variation->variation_id);
            }
            $productIds->push($product->id);
        }
        $intAttributes = ProductAttributeIntegerValue::whereIn('product_id', $productIds)->get()->unique('attribute_id');
        foreach ($intAttributes as $attrValue) {
            $attrs->push(['model' => Attribute::find($attrValue->attribute_id), 'type' => 'ATTRIBUTE']);
        }

        $intAttributes = ProductPropertyIntegerValue::whereIn('product_id', $productIds)->get()->unique('attribute_id');
        foreach ($intAttributes as $attrValue) {
            $attrs->push(['model' => Property::find($attrValue->property_id), 'type' => 'PROPERTY']);
        }

        return $attrs;
    }

    public function getAllCategories()
    {
        $data = [];

        $rootCategories = $this->where('parent_id', '=', null)->orWhere('parent_id', '=', 0)->get();
        $data = $this->list_categories($rootCategories);

        return $data;
    }

    public function getChilds($id)
    {
        return $this->where('parent_id', '=', $id)->get();
    }

    public function list_categories($categories)
    {
        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'object' => $category,
                'children' => $this->list_categories($category->children),
            ];
        }

        return $data;
    }
    */
}
