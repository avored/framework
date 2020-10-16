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
     * Find the language id from database
     */
    public function find(int $id): Language;

    /**
     * Update Language into database
     */
    public function update(array $data): Language;

    /**
     * Delete language from database
     */
    public function detele(int $id): int;

    /**
     * Fetch all records from database
     */
    public function all(): Collection;

}
