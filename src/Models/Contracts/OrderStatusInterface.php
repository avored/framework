<?php

namespace AvoRed\Framework\Models\Contracts;

interface OrderStatusInterface
{
    /**
     * Find a Order Status by given Id which returns Order Status Model
     *
     * @param $id
     * @return \AvoRed\Framework\Models\OrderStatus
     */
    public function find($id);

    /**
     * Find an All Order Status which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Order Status Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Order Status Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create a Order Status
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\OrderStatus
     */
    public function create($data);
}
