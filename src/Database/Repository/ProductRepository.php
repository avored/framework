<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductModelInterface
{
    /**
     * Create Product Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Find a Product by given slug
     * @param string $slug
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function findBySlug(string $slug): Product
    {
        return Product::whereSlug($slug)->first();
    }

    /**
     * Get all the products from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $products
     */
    public function all() : Collection
    {
        return Product::all();
    }
}
