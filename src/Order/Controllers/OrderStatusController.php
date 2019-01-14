<?php

namespace AvoRed\Framework\Order\Controllers;

use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Product\Requests\OrderStatusRequest;
use AvoRed\Framework\Models\Contracts\OrderStatusInterface;
use AvoRed\Framework\Order\DataGrid\OrderStatusDataGrid;
use AvoRed\Framework\System\Controllers\Controller;
use Illuminate\Support\Collection;

class OrderStatusController extends Controller
{
    protected $isDefaultOptins;
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\OrderStatusRepository
     */
    protected $repository;

    public function __construct(OrderStatusInterface $repository)
    {
        $this->repository = $repository;
        $this->isDefaultOptins = Collection::make(
            [['id' => 0, 'name' => 'No'],
            ['id' => 1, 'name' => 'Yes']]
        );
    }

    /**
     * Display a listing of the OrderStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderStateGrid = new OrderStatusDataGrid($this->repository->query());

        return view('avored-framework::order.order-status.index')
            ->withDataGrid($orderStateGrid->dataGrid);
    }

    /**
     * Show the form for creating a new OrderStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::order.order-status.create')
            ->with('isDefaultOptions', $this->isDefaultOptins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Framework\Product\Requests\OrderStatusRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderStatusRequest $request)
    {
        if ($request->is_default == 1) {
            $this->_setIsDefault();
        }

        $this->repository->create($request->all());

        return redirect()->route('admin.order-status.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\OrderStatus $order-status
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatus $orderStatus)
    {
        return view('avored-framework::order.order-status.edit')
            ->withModel($orderStatus)
            ->withIsDefaultOptions($this->isDefaultOptins);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\Product\Requests\OrderStatusRequest $request
     * @param \AvoRed\Framework\Models\Database\OrderStatus $order-status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrderStatusRequest $request, OrderStatus $orderStatus)
    {
        if ($request->is_default == 1) {
            $this->_setIsDefault();
        }
        $orderStatus->update($request->all());

        return redirect()->route('admin.order-status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \AvoRed\Framework\Models\Database\OrderStatus $order-status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(OrderStatus $orderStatus)
    {
        $orderStatus->delete();

        return redirect()->route('admin.order-status.index');
    }

    /**
     * Find a Record and Returns a Html Resrouce for that Record
     *
     * @return \Illuminate\Http\Response
     */
    public function show(OrderStatus $orderStatus)
    {
        return view('avored-framework::order.order-status.show')
            ->withOrderStatus($orderStatus);
    }

    /**
     * Set the Is Default for the Order Status
     * @return voide
     */
    private function _setIsDefault()
    {
        $model = $this->repository->query()->whereIsDefault(1)->first();

        if (null !== $model) {
            $model->update(['is_default' => 0]);
        }
    }
}
