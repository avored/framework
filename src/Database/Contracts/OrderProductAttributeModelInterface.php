<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\OrderProductAttribute;

interface OrderProductAttributeModelInterface
{
    /**
     * Create OrderProductAttribute Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\OrderProductAttribute $orderProduct
     */
    public function create(array $data) : OrderProductAttribute;

    /**
     * Find OrderProductAttribute Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderProductAttribute $orderProduct
     */
    public function find(int $id) : OrderProductAttribute;

    /**
     * Delete OrderProductAttribute Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All OrderProductAttribute from the database.
     * @return \Illuminate\Database\Eloquent\Collection $orderProducts
     */
    public function all() : Collection;
}
