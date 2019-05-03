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
     * Get all the categories from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection
    {
        return Category::all();
    }
}
