<?php

namespace AvoRed\Framework\Repository;

use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Models\Database\Attribute;
use AvoRed\Framework\Models\Database\Product as ProductModel;
use AvoRed\Framework\Models\Database\ProductAttributeIntegerValue;

class Product extends AbstractRepository
{
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
