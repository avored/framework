<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Models\Contracts\CountryInterface;
use AvoRed\Framework\Models\Contracts\TaxRateInterface;
use AvoRed\Framework\System\DataGrid\TaxRateDataGrid;
use AvoRed\Framework\System\Requests\TaxRateRequest;
use AvoRed\Framework\Models\Database\TaxRate;

class TaxRateController extends Controller
{
    /**
     * Tax Rate Repository
     * @var \AvoRed\Framework\Models\Repository\TaxRateRepository
     */
    protected $repository;

    /**
     * Country Repository
     * @var \AvoRed\Framework\Models\Repository\CountryRepository
     */
    protected $countryRepository;

    public function __construct(
        TaxRateInterface $repository,
        CountryInterface $countryRepository
    ) {
        $this->repository = $repository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = new TaxRateDataGrid(
            $this->repository->query()->orderBy('id', 'desc')
        );

        return view('avored-framework::system.tax-rate.index')
            ->withDataGrid($dataGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryOptions = $this->countryRepository->all()->pluck('name', 'id');

        return view('avored-framework::system.tax-rate.create')
            ->withCountryOptions($countryOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\TaxRateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaxRateRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.tax-rate.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\TaxRate $taxRate
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxRate $taxRate)
    {
        $countryOptions = $this->countryRepository->all()->pluck('name', 'id');

        return view('avored-framework::system.tax-rate.edit')
            ->with('model', $taxRate)
            ->withCountryOptions($countryOptions);
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\TaxRateRequest $request
     * @param \AvoRed\Framework\Models\Database\TaxRate $taxRate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaxRateRequest $request, TaxRate $taxRate)
    {
        $taxRate->update($request->all());

        return redirect()->route('admin.tax-rate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \AvoRed\Framework\Models\Database\TaxRate $taxRate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TaxRate $taxRate)
    {
        $taxRate->delete();
        return redirect()->route('admin.tax-rate.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \AvoRed\Framework\Models\Database\TaxRate $taxRate
     * @return \Illuminate\Http\Response
     */
    public function show(TaxRate $taxRate)
    {
        return view('avored-framework::system.tax-rate.show')
            ->with('taxRate', $taxRate);
    }

}
