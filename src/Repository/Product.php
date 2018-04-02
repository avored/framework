<?php

namespace AvoRed\Framework\Repository;

use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Models\Database\Attribute;
use AvoRed\Framework\Models\Database\Product as ProductModel;
use AvoRed\Framework\Models\Database\ProductAttributeIntegerValue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Product extends AbstractRepository
{


    /*
     * Return Products of Category with Filters
     *
     * @param integer $categoryId
     * @param array   $filters
     */
    public function getCategoryProductWithFilter($categoryId , $filters = []) {

        $prefix = config('database.connections.mysql.prefix');

        $sql = "Select p.id
                FROM {$prefix}products as p 
                INNER JOIN {$prefix}category_product as cp on p.id = cp.product_id ";


        foreach ($filters as $type => $filterArray) {
            if('property' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $property = $this->findPropertyByIdentifier($identifier);

                    if("INTEGER" == $property->data_type) {

                        $sql .= "INNER JOIN {$prefix}product_property_integer_values as ppiv ON p.id = ppiv.product_id ";
                    }

                }
            }
        }

        $sql .= "WHERE p.status=1 AND cp.category_id = ? ";

        foreach ($filters as $type => $filterArray) {
            if('property' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $property = $this->findPropertyByIdentifier($identifier);

                    if("INTEGER" == $property->data_type) {

                        $sql .= "AND ppiv.property_id = {$property->id} AND ppiv.value={$value}";
                    }

                }
            }
        }

        $products = DB::select($sql, [$categoryId]);

        $collect = Collection::make([]);

        foreach ($products as $productArray) {
            $collect->push($this->findProductById($productArray->id));
        }

        return $collect;

        /**
        * FROM avored_products as p
        *
         *
            *
            *
         * where ppiv.property_id = 1 AND
         */

    }


    /**
     * @param $slug
     * @return mixed
     */
    public function getBySlug($slug):ProductModel
    {
        return $this->model()->whereSlug($slug)->first();
    }

    public function model()
    {
        return new ProductModel();
    }

    public function categoryModel()
    {
        return new Category();
    }

    public function attributeModel()
    {
        return new Attribute();
    }

    public function integerAttributeModel()
    {
        return new ProductAttributeIntegerValue();
    }

    public function propertyModel()
    {
        return new Property();
    }

    /**
     * Find the Product By Slug.
     *
     * @param string $slug
     * @return \AvoRed\Framework\Models\Database\Product $product
     */
    public function findProductBySlug($slug):ProductModel
    {
        return $this->model()->whereSlug($slug)->first();
    }

    /**
     * Find the Product By Id.
     *
     * @param int $id
     * @return \AvoRed\Framework\Models\Database\Product $product
     */
    public function findProductById($id):ProductModel
    {
        return $this->model()->find($id);
    }

    /**
     * Find the Category By Slug.
     *
     * @param string $slug
     */
    public function findCategoryBySlug($slug):Category
    {
        return $this->categoryModel()->whereSlug($slug)->first();
    }

    /**
     * Create Category.
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\Database\Category $category
     */
    public function createCategory($data): Category
    {
        return $this->categoryModel()->create($data);
    }

    /**
     * Find Category BY Id.
     *
     * @param int $id
     * @return \AvoRed\Framework\Models\Database\Category $category
     */
    public function findCategoryById($id): Category
    {
        return $this->categoryModel()->find($id);
    }

    /**
     * Destroy Category.
     *
     * @param int $id
     * @return bool
     */
    public function destroyCategoryById($id)
    {
        return $this->categoryModel()->destroy($id);
    }

    /**
     * Create Attribute.
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\Database\Attribute $attribute
     */
    public function createAttribute($data):Attribute
    {
        return $this->attributeModel()->create($data);
    }

    /**
     * Find Attribute.
     *
     * @param int $id
     * @return \AvoRed\Framework\Models\Database\Attribute $attribute
     */
    public function findAttributeById($id):Attribute
    {
        return $this->attributeModel()->find($id);
    }

    /**
     * Find Property Model of a Product.
     *
     * @param string $identifier
     * @return \AvoRed\Framework\Models\Database\Property $property
     */
    public function findPropertyByIdentifier($identifier):Property
    {
        return $this->propertyModel()->whereIdentifier($identifier)->first();
    }

    /**
     * Destroy Attribute.
     *
     * @param int $id
     * @return bool
     */
    public function destroyAttributeById($id)
    {
        return $this->attributeModel()->destroy($id);
    }

}
