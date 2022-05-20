<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Database\Models\Page;
use AvoRed\Framework\Database\Traits\FilterTrait;

class PageRepository extends BaseRepository implements PageModelInterface
{
    use FilterTrait;

    /**
     * Filterable Fields
     * @var array
     */
    protected $filterFields = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
    ];

    /**
     * @var Page
     */
    protected $model;

    /**
     * Construct for the Page Repository
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    /**
     * Get the model for the repository
     * @return Page
     */
    public function model(): Page
    {
        return $this->model;
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
}
