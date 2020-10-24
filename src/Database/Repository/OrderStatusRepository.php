<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\OrderStatus;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class OrderStatusRepository extends BaseRepository implements OrderStatusModelInterface
{

    use FilterTrait;
    
    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
    ];


    /**
     * @var OrderStatus $model
     */
    protected $model;

    /**
     * Construct for the OrderStatus Repository
     */
    public function __construct()
    {
        $this->model = new OrderStatus();
    }

    /**
     * Get the model for the repository
     * @return OrderStatus 
     */
    public function model(): OrderStatus
    {
        return $this->model;
    }

    /**
     * Find OrderStatus Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     */
    public function findDefault(): OrderStatus
    {
        return OrderStatus::whereIsDefault(1)->first();
    }
}
