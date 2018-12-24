<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Models\Contracts\TaxGroupInterface;
use AvoRed\Framework\System\DataGrid\TaxGroupDataGrid;
use AvoRed\Framework\System\Requests\TaxGroupRequest;
use AvoRed\Framework\Models\Database\TaxGroup;

class TaxGroupController extends Controller
{
    /**
     * Tax Group Repository
     * @var \AvoRed\Framework\Models\Repository\TaxGroupRepository
     */
    protected $repository;

    public function __construct(TaxGroupInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = new TaxGroupDataGrid(
            $this->repository->query()->orderBy('id', 'desc')
        );

        return view('avored-framework::system.tax-group.index')
            ->withDataGrid($dataGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::system.tax-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\TaxGroupRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaxGroupRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.tax-group.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\State $state
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxGroup $taxGroup)
    {
        return view('avored-framework::system.tax-group.edit')
            ->with('model', $taxGroup);
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\TaxGroupRequest $request
     * @param \AvoRed\Framework\Models\Database\TaxGroup $taxGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaxGroupRequest $request, TaxGroup $taxGroup)
    {
        $taxGroup->update($request->all());

        return redirect()->route('admin.tax-group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \AvoRed\Framework\Models\Database\TaxGroup $taxGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TaxGroup $taxGroup)
    {
        $taxGroup->delete();
        return redirect()->route('admin.tax-group.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \AvoRed\Framework\Models\Database\TaxGroup $taxGroup
     * @return \Illuminate\Http\Response
     */
    public function show(TaxGroup $taxGroup)
    {
        return view('avored-framework::system.tax-group.show')
            ->with('taxGroup', $taxGroup);
    }

}
