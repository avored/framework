<?php

namespace AvoRed\Framework\Api\Controllers;

use AvoRed\Framework\Models\Database\Order;
use AvoRed\Framework\Api\Resources\Order\OrderCollectionResource;
use AvoRed\Framework\Api\Resources\Order\OrderResource;

class OrderController extends Controller
{
    /**
     * Return upto 10 Record for an Resource in Json Formate
     *
     * @return \Illuminate\Http\Resources\CollectsResources
     */
    public function index()
    {
        $orders = Order::with(['orderStatus'])->latest()->paginate(10);

        return new OrderCollectionResource($orders);
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        $order = Order::find($id);
        return new OrderResource($order);
    }
}
