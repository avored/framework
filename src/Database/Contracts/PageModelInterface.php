<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Page;
use Illuminate\Database\Eloquent\Collection;

interface PageModelInterface
{
    /**
     * Create Page Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function create(array $data) : Page;

    /**
     * Find Page Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function find(int $id) : Page;

    /**
     * Find Page Resource into a database.
     * @param string $slug
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function findBySlug(string $slug);

    /**
     * Delete Page Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All Page from the database.
     * @return \Illuminate\Database\Eloquent\Collection $pages
     */
    public function all() : Collection;
}
