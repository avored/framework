<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Category;
use Illuminate\Support\Collection as SupportCollection;

interface CategoryModelInterface extends BaseInterface
{

    /**
     * Find Category Resource into a database.
     * @param string $id
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function findBySlug(string $slug) : Category;


    /**
     * Get All Category from the database.
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function getCategoryProducts(Request $request) : Collection;

    /**
     * Get all the categories option to use in Menu Builder.
     * @return \Illuminate\Support\Collection $categories
     */
    public function getCategoryOptionForMenuBuilder() : SupportCollection;

    /**
     * Get All Category from the database.
     * @param string $label
     * @param mixed $value
     * @return \Illuminate\Support\Collection $categoryOptions
     */
    public function options(string $label = 'name', $value = 'id' ) : SupportCollection;
}
