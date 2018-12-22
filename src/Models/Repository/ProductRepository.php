<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Contracts\ProductInterface;

class ProductRepository implements ProductInterface
{
    /**
     * Find a Product by a given id of a product
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\Product
     */
    public function find($id)
    {
        return Product::find($id);
    }

    /**
     * Find a Product by a given id of a product
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\Product
     */
    public function findBySlug($slug)
    {
        return Product::whereSlug($slug)->first();
    }

    /**
     * Product Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Product::query();
    }

    /**
     * Find all product except the Variable Product to display
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Product::all();
    }
}
