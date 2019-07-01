<?php
namespace AvoRed\Framework\Order\Controllers;

use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Order\Requests\OrderRequest;

class OrderController
{
    /**
     * Order Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\OrderRepository $orderRepository
     */
    protected $orderRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Repository\OrderRepository $orderRepository
     */
    public function __construct(
        OrderModelInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->all();

        return view('avored::order.order.index')
            ->with('orders', $orders);
    }

     /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored::order.order.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Order\Requests\OrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $this->orderRepository->create($request->all());

        return redirect()->route('admin.order.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::order.order.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('avored::order.order.edit')
            ->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Order\Requests\OrderRequest $request
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('admin.order.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::order.order.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return [
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::order.order.title')]
            )
        ];
    }
}
