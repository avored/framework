<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryModelInterface
{
    /**
     * Create Category Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Find Category Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function find(int $id): Category
    {
        return Category::find($id);
    }

    /**
     * Delete Category Resource from a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function delete(int $id): bool
    {
        return Category::destroy($id);
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
