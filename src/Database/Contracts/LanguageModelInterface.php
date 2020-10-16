<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Language;

interface LanguageModelInterface extends BaseInterface
{
    /**
     * Create language into database
     */
    public function create(array $data): Language;

    /**
     * Find id from database
     */
    public function find(int $id): Language;

    /**
     * Delete language from database
     */
    public function detele(int $id): int;

    /**
     * Fetch all records from database
     */
    public function all(): Collection;

}
