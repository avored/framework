<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Models\Contracts\CategoryInterface;

class CategoryRepository implements CategoryInterface
{
    /**
     * Find an Category by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Database\Category
     */
    public function find($id)
    {
        return Category::find($id);
    }

    /**
     * Find an Category by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Category::all();
    }

    /**
     * Paginate Category
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Category::paginate($noOfItem);
    }

    /**
     * Find an Category Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Category::query();
    }

    /**
     * Find an Category Query
     *
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function create($data)
    {
        return Category::create($data);
    }
}
