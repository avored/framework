<?php

namespace AvoRed\Framework\Order\Controllers;

use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Models\OrderStatus;
use AvoRed\Framework\Order\Requests\OrderStatusRequest;
use AvoRed\Framework\Tab\Tab;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class OrderStatusController extends Controller
{
    /**
     * @var OrderStatusRepository
     */
    protected $orderStatusRepository;

    /**
     *
     * @param OrderStatusRepositroy $repository
     */
    public function __construct(
        OrderStatusModelInterface $repository
    ) {
        $this->orderStatusRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderStatuses = $this->orderStatusRepository->paginate();

        return view('avored::order.order-status.index')
            ->with('orderStatuses', $orderStatuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabs = Tab::get('order.order-status');

        return view('avored::order.order-status.create')
            ->with('tabs', $tabs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderStatusRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusRequest $request)
    {
        if ($request->has('is_default')) {
            $this->orderStatusRepository->updateDefaultOrderStatusToNull();
        }
        $this->orderStatusRepository->create($request->all());

        return redirect(route('admin.order-status.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatus $orderStatus)
    {
        $tabs = Tab::get('order.order-status');

        return view('avored::order.order-status.edit')
            ->with('orderStatus', $orderStatus)
            ->with('tabs', $tabs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderStatusRequest  $request
     * @param OrderStatus $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStatusRequest $request, OrderStatus $orderStatus)
    {
        if ($request->has('is_default')) {
            $this->orderStatusRepository->updateDefaultOrderStatusToNull();
        }
        $orderStatus->update($request->all());

        return redirect(route('admin.order-status.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OrderStatus $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatus $orderStatus)
    {
        $orderStatus->delete();

        return new JsonResponse([
            'success' => true,
            'message' => __('avored::system.success_delete_message', ['attribute' => __('avored::system.order-status')]),
        ]);
    }
}
