<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\ProductVariation;
use AvoRed\Framework\Database\Contracts\ProductVariationModelInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductVariationRepository implements ProductVariationModelInterface
{
    /**
     * Create ProductVariation Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\ProductVariation $productVariation
     */
    public function create(array $data): ProductVariation
    {
        return ProductVariation::create($data);
    }

    /**
     * Find ProductVariation Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\ProductVariation $productVariation
     */
    public function find(int $id): ProductVariation
    {
        return ProductVariation::find($id);
    }

    /**
     * Delete ProductVariation Resource from a database
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return ProductVariation::destroy($id);
    }

    /**
     * Get all the productVariations from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $productVariations
     */
    public function all() : Collection
    {
        return ProductVariation::all();
    }
}
