<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class OrderRepository extends BaseRepository implements OrderModelInterface
{
    use FilterTrait;

    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'shipping_option',
        'payment_option',
    ];

    /**
     * @var Order $model
     */
    protected $model;

    /**
     * Construct for the Order Repository
     */
    public function __construct()
    {
        $this->model = new Order();
    }

    /**
     * Get the model for the repository
     * @return Order 
     */
    public function model(): Order
    {
        return $this->model;
    }
  
    /**
     * Find Orders of a given user Id.
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection $userOrders
     */
    public function findByCustomerId(int $id) : LengthAwarePaginator
    {
        return Order::whereCustomerId($id)->paginate();
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
        $orders = Order::with('products')
            ->select('*')
            ->where('created_at', '>', $firstDay)
            ->get();

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
