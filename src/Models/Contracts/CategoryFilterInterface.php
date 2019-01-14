<?php

namespace AvoRed\Framework\Models\Contracts;

interface CategoryFilterInterface
{
    /**
     * Find a Category filter by Id
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\CategoryFilter
     */
    public function find($id);

    /**
     * Category Filter Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Save Categoy Filter
     * @param integer $categoryId
     * @param integer $filterId
     * @param string $type
     * @return \AvoRed\Framework\Models\Database\CategoryFilter
     */
    public function saveFilter($categoryId, $filterId, $type);
}
