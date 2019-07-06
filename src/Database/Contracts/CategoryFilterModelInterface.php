<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\CategoryFilter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface CategoryFilterModelInterface
{
    /**
     * Create CategoryFilter Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\CategoryFilter $category
     */
    public function create(array $data) : CategoryFilter;

    /**
     * Find CategoryFilter Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\CategoryFilter $category
     */
    public function find(int $id) : CategoryFilter;
    
    /**
     * Delete CategoryFilter Resource from a database
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;

    /**
     * Get All CategoryFilter from the database
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection;
}
