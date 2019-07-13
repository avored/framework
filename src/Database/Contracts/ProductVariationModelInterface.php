<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\ProductVariation;
use Illuminate\Database\Eloquent\Collection;

interface ProductVariationModelInterface
{
    /**
     * Create ProductVariation Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\ProductVariation $productVariation
     */
    public function create(array $data) : ProductVariation;

    /**
     * Find ProductVariation Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\ProductVariation $productVariation
     */
    public function find(int $id) : ProductVariation;

    /**
     * Delete ProductVariation Resource from a database
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All ProductVariation from the database
     * @return \Illuminate\Database\Eloquent\Collection $productVariations
     */
    public function all() : Collection;
}
