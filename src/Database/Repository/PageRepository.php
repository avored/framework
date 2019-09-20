<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Contracts\PageModelInterface;

class PageRepository implements PageModelInterface
{
    /**
     * Create Page Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function create(array $data): Page
    {
        return Page::create($data);
    }

    /**
     * Find Page Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function find(int $id): Page
    {
        return Page::find($id);
    }
    /**
     * Find Page Resource into a database.
     * @param string $slug
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function findBySlug(string $slug)
    {
        return Page::whereSlug($slug)->first();
    }

    /**
     * Delete Page Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Page::destroy($id);
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $pages
     */
    public function all() : Collection
    {
        return Page::all();
    }
}
