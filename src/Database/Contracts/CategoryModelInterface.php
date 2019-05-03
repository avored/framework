<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryModelInterface
{
    /**
     * Create Category Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function create(array $data) : Category;

    /**
     * Get All Category from the database
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection;
}
