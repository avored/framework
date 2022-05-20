<?php

namespace AvoRed\Framework\Order\Controllers;

use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     *
     * @param OrderRepositroy $repository
     */
    public function __construct(
        OrderModelInterface $repository
    ) {
        $this->orderRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderes = $this->orderRepository->paginate();

        return view('avored::order.order.index')
            ->with('orders', $orderes);
    }
}
