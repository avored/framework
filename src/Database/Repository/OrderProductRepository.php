<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\OrderProduct;
use AvoRed\Framework\Database\Contracts\OrderProductModelInterface;
use AvoRed\Framework\Order\Events\OrderProductCreated;

class OrderProductRepository extends BaseRepository implements OrderProductModelInterface
{
    /**
     * @var OrderProduct $model
     */
    protected $model;

    /**
     * Construct for the OrderProduct Repository
     */
    public function __construct()
    {
        $this->model = new OrderProduct();
    }

    /**
     * Get the model for the repository
     * @return OrderProduct 
     */
    public function model(): OrderProduct
    {
        return $this->model;
    }

    /**
     * Create OrderProduct Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\OrderProduct $orderProduct
     */
    public function create(array $data): OrderProduct
    {
        $orderProduct = parent::create($data);
        event(new OrderProductCreated($orderProduct));

        return $orderProduct;
    }
}
