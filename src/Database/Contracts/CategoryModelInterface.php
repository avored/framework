<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Category;
use Illuminate\Support\Collection as SupportCollection;

interface CategoryModelInterface
{
    /**
     * Create Category Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function create(array $data) : Category;

    /**
     * Find Category Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function find(int $id) : Category;

    /**
     * Find Category Resource into a database.
     * @param string $id
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function findBySlug(string $slug) : Category;

    /**
     * Delete Category Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All Category from the database.
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function getCategoryProducts(Request $request) : Collection;

    /**
     * Get All Category from the database.
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection;

    /**
     * Get all the categories option to use in Menu Builder.
     * @return \Illuminate\Support\Collection $categories
     */
    public function getCategoryOptionForMenuBuilder() : SupportCollection;

    /**
     * Get All Category from the database.
     * @return \Illuminate\Support\Collection $categoryOptions
     */
    public function options() : SupportCollection;
}
