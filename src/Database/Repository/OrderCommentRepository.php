<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\OrderComment;
use AvoRed\Framework\Database\Contracts\OrderCommentModelInterface;

class OrderCommentRepository extends BaseRepository implements OrderCommentModelInterface
{
    /**
     * @var OrderComment $model
     */
    protected $model;

    /**
     * Construct for the OrderComment Repository
     */
    public function __construct()
    {
        $this->model = new OrderComment();
    }

    /**
     * Get the model for the repository
     * @return OrderComment 
     */
    public function model(): OrderComment
    {
        return $this->model;
    }
}
