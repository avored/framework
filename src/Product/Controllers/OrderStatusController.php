<?php

namespace AvoRed\Framework\Product\Controllers;

use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Product\Requests\OrderStatusRequest;
use AvoRed\Framework\Models\Contracts\OrderStatusInterface;
use AvoRed\Framework\Product\DataGrid\OrderStatusDataGrid;
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
        $this->isDefaultOptins = Collection::make([
            ['id' => 0, 'name' => 'No'],
            ['id' => 1, 'name' => 'Yes'],
        ]);
    }

    /**
     * Display a listing of the OrderStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderStateGrid = new OrderStatusDataGrid($this->repository->query());

        return view('avored-framework::product.order-status.index')->with('dataGrid', $orderStateGrid->dataGrid);
    }

    /**
     * Show the form for creating a new OrderStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::product.order-status.create')
            ->with('isDefaultOptions', $this->isDefaultOptins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Framework\Product\Requests\OrderStatusRequest $request
     *
     * @return \Illuminate\Http\Response
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
        return view('avored-framework::product.order-status.edit')
                ->with('model', $orderStatus)
                ->with('isDefaultOptions', $this->isDefaultOptins);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\Product\Requests\OrderStatusRequest $request
     * @param \AvoRed\Framework\Models\Database\OrderStatus $order-status
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
        return view('avored-framework::product.order-status.show')->with('orderStatus', $orderStatus);
    }

    private function _setIsDefault()
    {
        $model = $this->repository->query()->whereIsDefault(1)->first();

        if (null !== $model) {
            $model->update(['is_default' => 0]);
        }
    }
}
