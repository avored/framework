<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface CategoryModelInterface
{
    /**
     * Create Category Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function create(array $data) : Category;

    /**
     * Find Category Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function find(int $id) : Category;

    /**
     * Delete Category Resource from a database
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;

    /**
     * Get All Category from the database
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection;

    /**
     * Get All Category from the database
     * @return \Illuminate\Support\Collection $categoryOptions
     */
    public function options() : SupportCollection;
}
