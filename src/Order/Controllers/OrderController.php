<?php
namespace AvoRed\Framework\Order\Controllers;

use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Order\Requests\OrderChangeStatusRequest;

class OrderController
{
    /**
     * Order Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\OrderRepository $orderRepository
     */
    protected $orderRepository;
    
    /**
     * Order Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\OrderStatusRepository $orderStatusRepository
     */
    protected $orderStatusRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Contracts\OrderModelInterface $orderRepository
     */
    public function __construct(
        OrderModelInterface $orderRepository,
        OrderStatusModelInterface $orderStatusRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->all();
        $orderStatuses = $this->orderStatusRepository->all();

        return view('avored::order.order.index')
            ->with('orderStatuses', $orderStatuses)
            ->with('orders', $orders);
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Order\Requests\OrderChangeStatusRequest  $request
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(OrderChangeStatusRequest $request, Order $order)
    {
        $order->update($request->all());

        return [
            'success' => true,
            'message' => __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::order.order.index.title')]
            )
        ];
    }
}
