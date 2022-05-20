<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Subscriber;
use AvoRed\Framework\Database\Contracts\SubscriberModelInterface;

class SubscriberRepository extends BaseRepository implements SubscriberModelInterface
{
    /**
     * @var Subscriber $model
     */
    protected $model;

    /**
     * Construct for the Subscriber Repository
     */
    public function __construct()
    {
        $this->model = new Subscriber();
    }

    /**
     * Get the model for the repository
     * @return Subscriber
     */
    public function model(): Subscriber
    {
        return $this->model;
    }
}
