<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Document;
use AvoRed\Framework\Database\Contracts\DocumentModelInterface;

class DocumentRepository extends BaseRepository implements DocumentModelInterface
{
    /**
     * @var Document $model
     */
    protected $model;

    /**
     * Construct for the Document Repository
     */
    public function __construct()
    {
        $this->model = new Document();
    }

    /**
     * Get the model for the repository
     * @return Document
     */
    public function model(): Document
    {
        return $this->model;
    }
}
