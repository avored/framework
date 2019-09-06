<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\AttributeProductValue;
use AvoRed\Framework\Database\Contracts\AttributeProductValueModelInterface;

class AttributeProductValueRepository implements AttributeProductValueModelInterface
{
    /**
     * Create AttributeProductValue Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function create(array $data): AttributeProductValue
    {
        return AttributeProductValue::create($data);
    }

    /**
     * Find AttributeProductValue Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function find(int $id): AttributeProductValue
    {
        return AttributeProductValue::find($id);
    }

    /**
     * Delete AttributeProductValue Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return AttributeProductValue::destroy($id);
    }

    /**
     * Find AttributeProductValue Resource into a database.
     * @param int $productId
     * @param int $attributeId
     * @param int $optionId
     * @param int $variationId
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function findByAttributeProductValues(int $productId, int $attributeId, int $optionId, int $variationId)
    {
        return AttributeProductValue::whereProductId($productId)
            ->whereAttributeId($attributeId)
            ->whereAttributeDropdownOptionId($optionId)
            ->whereVariationId($variationId)
            ->first();
    }

    /**
     * Find AttributeProductValue Resource into a database.
     * @param int $productId
     * @param int $variationId
     * @param int $optionId
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function getModelByProductIdAndVariationId(int $productId, int $variationId)
    {
        return AttributeProductValue::whereProductId($productId)
            ->whereVariationId($variationId)
            ->get();
    }

    /**
     * Get all the attribute product values from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $attributeProductValues
     */
    public function all() : Collection
    {
        return AttributeProductValue::all();
    }
}
