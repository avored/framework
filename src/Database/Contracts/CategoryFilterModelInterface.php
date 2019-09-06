<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\CategoryFilter;

interface CategoryFilterModelInterface
{
    /**
     * Create CategoryFilter Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\CategoryFilter $categoryFilter
     */
    public function create(array $data) : CategoryFilter;

    /**
     * Find CategoryFilter Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\CategoryFilter $categoryFilter
     */
    public function find(int $id) : CategoryFilter;

    /**
     * Find CategoryFilters by given category id.
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection $categoryFilters
     */
    public function findByCategoryId(int $id) : Collection;

    /**
     * Find Category filter by given category and filter and type.
     * @param int $cateogryId
     * @param int $filterId
     * @param string $type
     * @return mixex $categoryFilter
     */
    public function isCategoryFilterModelExist(int $categoryId, int $filterId, $type);

    /**
     * Delete CategoryFilter Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All CategoryFilter from the database.
     * @return \Illuminate\Database\Eloquent\Collection $categoryFilters
     */
    public function all() : Collection;
}
