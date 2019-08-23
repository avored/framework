<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\AttributeProductValue;
use Illuminate\Database\Eloquent\Collection;

interface AttributeProductValueModelInterface
{
    /**
     * Create AttributeProductValue Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function create(array $data) : AttributeProductValue;

    /**
     * Find AttributeProductValue Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function find(int $id) : AttributeProductValue;

    /**
     * Find AttributeProductValue Resource into a database
     * @param int $productId
     * @param int $attributeId
     * @param int $optionId
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function findByAttributeProductValues(int $productId, int $attributeId, int $optionId);

    /**
     * Find AttributeProductValue Resource into a database
     * @param int $productId
     * @param int $variationId
     * @param int $optionId
     * @return \AvoRed\Framework\Database\Models\AttributeProductValue $attributeProductValue
     */
    public function getModelByProductIdAndVariationId(int $productId, int $variationId);

    /**
     * Delete AttributeProductValue Resource from a database
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All AttributeProductValue from the database
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function all() : Collection;
}
