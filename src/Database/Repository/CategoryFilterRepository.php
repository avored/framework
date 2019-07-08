<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\CategoryFilter;
use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use AvoRed\Framework\Database\Models\Category;

class CategoryFilterRepository implements CategoryFilterModelInterface
{
    /**
     * Create CategoryFilter Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\CategoryFilter $category
     */
    public function create(array $data): CategoryFilter
    {
        return CategoryFilter::create($data);
    }

    /**
     * Find CategoryFilter Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\CategoryFilter $category
     */
    public function find(int $id): CategoryFilter
    {
        return CategoryFilter::find($id);
    }

    /**
     * Find CategoryFilters by given category id
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection $categoryFilters
     */
    public function findByCategoryId(int $id) : Collection
    {
        return CategoryFilter::whereCategoryId($id)->get()->unique('filter_id');
    }

    /**
     * Delete CategoryFilter Resource from a database
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return CategoryFilter::destroy($id);
    }

    /**
     * Get all the categories from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection
    {
        return Category::all();
    }
}
