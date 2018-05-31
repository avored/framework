<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Contracts\ProductInterface;

class ProductRepository implements ProductInterface
{
    /**
     * Product Eloquent Database Model
     * @var \AvoRed\Framework\Models\Database\Product
     */
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Find a Product by a given id of a product
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\Product
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
    * Find a Product by a given id of a product
    *
    * @param integer $id
    * @return \AvoRed\Framework\Models\Database\Product
    */
    public function findBySlug($slug)
    {
        return $this->model->whereSlug($slug)->first();
    }
}
