<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\AttributeDropdownOption;
use AvoRed\Framework\Database\Contracts\AttributeDropdownOptionModelInterface;

class AttributeDropdownOptionRepository implements AttributeDropdownOptionModelInterface
{
    /**
     * Create AttributeDropdownOption Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AttributeDropdownOption $attributeDropdownOption
     */
    public function create(array $data): AttributeDropdownOption
    {
        return AttributeDropdownOption::create($data);
    }

    /**
     * Find AttributeDropdownOption Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\AttributeDropdownOption $attributeDropdownOption
     */
    public function find(int $id): AttributeDropdownOption
    {
        return AttributeDropdownOption::find($id);
    }

    /**
     * Delete AttributeDropdownOption Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return AttributeDropdownOption::destroy($id);
    }

    /**
     * Get all the attributes from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $attributeDropdownOptions
     */
    public function all() : Collection
    {
        return AttributeDropdownOption::all();
    }
}
