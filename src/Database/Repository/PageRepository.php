<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Page;
use AvoRed\Framework\Database\Contracts\PageModelInterface;
use Illuminate\Database\Eloquent\Collection;

class PageRepository implements PageModelInterface
{
    /**
     * Create Page Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function create(array $data): Page
    {
        return Page::create($data);
    }

    /**
     * Find Page Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function find(int $id): Page
    {
        return Page::find($id);
    }

    /**
     * Delete Page Resource from a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function delete(int $id): bool
    {
        return Page::destroy($id);
    }

    /**
     * Get all the categories from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $pages
     */
    public function all() : Collection
    {
        return Page::all();
    }
}
