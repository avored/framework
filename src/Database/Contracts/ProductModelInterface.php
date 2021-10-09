<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductModelInterface
{

    /**
     * Get all the products from the connected database.
     * @param int $perPage
     * @return \Illuminate\Database\Eloquent\Collection $products
     */
    public function getAllWithoutVaiation(int $perPage = 10): LengthAwarePaginator;

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
}
