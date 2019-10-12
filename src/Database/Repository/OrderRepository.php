<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use Illuminate\Support\Carbon;

class OrderRepository implements OrderModelInterface
{
    /**
     * Create Order Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Order $order
     */
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    /**
     * Find Order Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Order $order
     */
    public function find(int $id): Order
    {
        return Order::find($id);
    }

    /**
     * Find Orders of a given user Id.
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection $userOrders
     */
    public function findByUserId(int $id) : Collection
    {
        return Order::whereUserId($id)->get();
    }

    /**
     * Delete Order Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Order::destroy($id);
    }

    /**
     * Get all the orders from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $orders
     */
    public function all() : Collection
    {
        return Order::all();
    }

    /**
     * Get no of  order by given month
     * @return int $totalOrders
     */
    public function getCurrentMonthTotalOrder() : int
    {
        $firstDay = $this->getFirstDay();
        $totalOrder = Order::select('id')->where('created_at', '>', $firstDay)->count();
        
        return $totalOrder;
    }
    /**
     * Get Total Revenue of current month
     * @return int $totalOrders
     */
    public function getCurrentMonthTotalRevenue() : float
    {
        $total = 0;
        $firstDay = $this->getFirstDay();
        $orders = Order::select('*')->where('created_at', '>', $firstDay)->get();

        foreach ($orders as $order) {
            foreach ($order->products as $product) {
                $total += ($product->qty * $product->price) + $product->tax_amount;
            }
        }
        
        return $total;
    }

    private function getFirstDay()
    {
        $startDay = Carbon::now();
        return $startDay->firstOfMonth();
    }
}
