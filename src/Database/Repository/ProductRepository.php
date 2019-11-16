<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;

class ProductRepository implements ProductModelInterface
{
    /**
     * Create Product Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Find a Product by given slug.
     * @param string $slug
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function findBySlug(string $slug): Product
    {
        return Product::whereSlug($slug)->first();
    }

    /**
     * Find a Product by given barcode.
     * @param string $barcode
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function findByBarcode(string $barcode): Product
    {
        return Product::whereBarcode($barcode)->first();
    }

    /**
     * Find a Product by given id.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function find(int $id): Product
    {
        return Product::find($id);
    }

    /**
     * Get all the products from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $products
     */
    public function all() : Collection
    {
        return Product::all();
    }

    /**
     * Get all the products from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $products
     */
    public function getAllWithoutVaiation() : Collection
    {
        return Product::where('type', '!=', 'VARIATION')->get();
    }

    /**
     * Delete Product Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Product::destroy($id);
    }
}
