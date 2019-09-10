<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\OrderProductAttribute;
use AvoRed\Framework\Database\Contracts\OrderProductAttributeModelInterface;

class OrderProductAttributeRepository implements OrderProductAttributeModelInterface
{
    /**
     * Create OrderProductAttribute Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\OrderProductAttribute $orderProduct
     */
    public function create(array $data): OrderProductAttribute
    {
        return OrderProductAttribute::create($data);
    }

    /**
     * Find OrderProductAttribute Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderProductAttribute $orderProduct
     */
    public function find(int $id): OrderProductAttribute
    {
        return OrderProductAttribute::find($id);
    }

    /**
     * Delete OrderProductAttribute Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return OrderProductAttribute::destroy($id);
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $orderProducts
     */
    public function all() : Collection
    {
        return OrderProductAttribute::all();
    }
}
