<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Product;

interface ProductModelInterface
{
    /**
     * Create Product Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function create(array $data) : Product;

    /**
     * Get all the products from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $products
     */
    public function all() : Collection;

    /**
     * Get all the products from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $products
     */
    public function getAllWithoutVaiation() : Collection;

    /**
     * Find a Product by given id.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function find(int $id): Product;

    /**
     * Find a Product by given slug.
     * @param string $slug
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function findBySlug(string $slug): Product;

    /**
     * Find a Product by given barcode.
     * @param string $barcode
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function findByBarcode(string $barcode): Product;

    /**
     * Delete Address Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;
}
