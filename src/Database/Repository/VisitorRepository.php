<?php
namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Visitor;
use AvoRed\Framework\Database\Contracts\VisitorModelInterface;

class VisitorRepository extends BaseRepository implements VisitorModelInterface
{
    /**
     * @var Visitor $model
     */
    protected $model;

    /**
     * Construct for the Visitor Repository
     */
    public function __construct()
    {
        $this->model = new Visitor();
    }

    /**
     * Get the model for the repository
     * @return Visitor
     */
    public function model(): Visitor
    {
        return $this->model;
    }
}
