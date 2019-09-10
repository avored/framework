<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\AttributeProductValue;

interface AttributeProductValueModelInterface
{
    /**
     * Create AttributeProductValue Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function create(array $data) : AttributeProductValue;

    /**
     * Find AttributeProductValue Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function find(int $id) : AttributeProductValue;

    /**
     * Find AttributeProductValue Resource into a database.
     * @param int $productId
     * @param int $attributeId
     * @param int $optionId
     * @param int $variationId
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function findByAttributeProductValues(int $productId, int $attributeId, int $optionId, int $variationId);

    /**
     * Find AttributeProductValue Resource into a database.
     * @param int $productId
     * @param int $variationId
     * @param int $optionId
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function getModelByProductIdAndVariationId(int $productId, int $variationId);

    /**
     * Delete AttributeProductValue Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All AttributeProductValue from the database.
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function all() : Collection;
}
