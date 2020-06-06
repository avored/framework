<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Page;
use Illuminate\Database\Eloquent\Collection;

interface PageModelInterface extends BaseInterface
{
    /**
     * Find Page Resource into a database.
     * @param string $slug
     * @return \AvoRed\Framework\Database\Models\Page $page
     */
    public function findBySlug(string $slug);
}
