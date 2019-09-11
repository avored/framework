<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\AttributeDropdownOption;

interface AttributeDropdownOptionModelInterface
{
    /**
     * Create AttributeDropdownOption Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AttributeDropdownOption $attributeDropdownOption
     */
    public function create(array $data) : AttributeDropdownOption;

    /**
     * Find AttributeDropdownOption Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\AttributeDropdownOption $attributeDropdownOption
     */
    public function find(int $id) : AttributeDropdownOption;

    /**
     * Delete AttributeDropdownOption Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All AttributeDropdownOption from the database.
     * @return \Illuminate\Database\Eloquent\Collection $attributeDropdownOptions
     */
    public function all() : Collection;
}
