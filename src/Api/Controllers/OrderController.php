<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Order;
use AvoRed\Framework\Api\Controllers\Controller;
use AvoRed\Framework\Api\Resources\Order\OrderCollectionResource;
use AvoRed\Framework\Api\Resources\Order\OrderResource;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);

        return new OrderCollectionResource($orders);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

}
