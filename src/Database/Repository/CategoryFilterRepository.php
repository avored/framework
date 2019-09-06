<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Models\CategoryFilter;
use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;

class CategoryFilterRepository implements CategoryFilterModelInterface
{
    /**
     * Create CategoryFilter Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\CategoryFilter $category
     */
    public function create(array $data): CategoryFilter
    {
        return CategoryFilter::create($data);
    }

    /**
     * Find CategoryFilter Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\CategoryFilter $category
     */
    public function find(int $id): CategoryFilter
    {
        return CategoryFilter::find($id);
    }

    /**
     * Find Category filter by given category and filter and type.
     * @param int $cateogryId
     * @param int $filterId
     * @param string $type
     * @return mixex $categoryFilter
     */
    public function isCategoryFilterModelExist(int $categoryId, int $filterId, $type)
    {
        $model = CategoryFilter::whereCategoryId($categoryId)
            ->whereFilterId($filterId)
            ->whereType($type)->first();

        if ($model !== null) {
            return true;
        }

        return false;
    }

    /**
     * Find CategoryFilters by given category id.
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection $categoryFilters
     */
    public function findByCategoryId(int $id) : Collection
    {
        return CategoryFilter::whereCategoryId($id)->get();
    }

    /**
     * Delete CategoryFilter Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return CategoryFilter::destroy($id);
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection
    {
        return Category::all();
    }
}
