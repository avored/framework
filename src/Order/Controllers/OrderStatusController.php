<?php

namespace AvoRed\Framework\Order\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\OrderStatus;
use AvoRed\Framework\Order\Requests\OrderStatusRequest;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use Illuminate\Http\Request;

class OrderStatusController
{
    /**
     * OrderStatus Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\OrderStatusRepository
     */
    protected $orderStatusRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\OrderModelInterface $orderStatusRepository
     */
    public function __construct(
        OrderStatusModelInterface $orderStatusRepository
    ) {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderStatuses = $this->orderStatusRepository->paginate();

        return view('avored::order.order-status.index')
            ->with(compact('orderStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabs = Tab::get('order.order-status');

        return view('avored::order.order-status.create')
            ->with(compact('tabs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Order\Requests\OrderStatusRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusRequest $request)
    {
        $this->orderStatusRepository->create($request->all());

        return redirect()->route('admin.order-status.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::order.order-status.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatus $orderStatus)
    {
        $tabs = Tab::get('order.order-status');

        return view('avored::order.order-status.edit')
            ->with(compact('orderStatus', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Order\Requests\OrderStatusRequest $request
     * @param \AvoRed\Framework\Database\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStatusRequest $request, OrderStatus $orderStatus)
    {
        $orderStatus->update($request->all());

        return redirect()->route('admin.order-status.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::order.order-status.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatus $orderStatus)
    {
        $orderStatus->delete();

        return [
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::order.order-status.title')]
            ),
        ];
    }

    /**
     * Filter for Category Table.
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        return $this->orderStatusRepository->filter($request->get('filter'));
    }
}
