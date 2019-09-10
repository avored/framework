<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Database\Models\TaxRate;
use AvoRed\Framework\System\Requests\TaxRateRequest;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;
use AvoRed\Framework\Database\Contracts\TaxRateModelInterface;

class TaxRateController
{
    /**
     * TaxRate Repository for Controller.
     * @var \AvoRed\Framework\Database\Repository\TaxRateRepository
     */
    protected $taxRateRepository;

    /**
     * Country Repository for the State Controller.
     * @var \AvoRed\Framework\Database\Repository\CountryRepository
     */
    protected $countryRepository;

    /**
     * Construct for the AvoRed tax rate controller.
     * @param \AvoRed\Framework\Database\Contracts\TaxRateModelInterface $taxRateRepository
     * @param \AvoRed\Framework\Database\Contracts\CountryModelInterface $countryRepository
     */
    public function __construct(
        TaxRateModelInterface $taxRateRepository,
        CountryModelInterface $countryRepository
    ) {
        $this->taxRateRepository = $taxRateRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $taxRates = $this->taxRateRepository->all();

        return view('avored::system.tax-rate.index')
            ->with(compact('taxRates'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $typeOptions = TaxRate::RATE_TYPE_OPTIONS;
        $countryOptions = $this->countryRepository->options();

        return view('avored::system.tax-rate.create')
            ->with(compact('typeOptions', 'countryOptions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\TaxRateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaxRateRequest $request)
    {
        $this->taxRateRepository->create($request->all());

        return redirect()->route('admin.tax-rate.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::system.tax-rate.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\TaxRate $taxRate
     * @return \Illuminate\View\View
     */
    public function edit(TaxRate $taxRate)
    {
        $typeOptions = TaxRate::RATE_TYPE_OPTIONS;
        $countryOptions = $this->countryRepository->options();

        return view('avored::system.tax-rate.edit')
            ->with(compact('taxRate', 'typeOptions', 'countryOptions'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\TaxRateRequest $request
     * @param \AvoRed\Framework\Database\Models\TaxRate  $taxRate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaxRateRequest $request, TaxRate $taxRate)
    {
        $taxRate->update($request->all());

        return redirect()->route('admin.tax-rate.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::system.tax-rate.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\TaxRate  $taxRate
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TaxRate $taxRate)
    {
        $taxRate->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::system.tax-rate.title')]
            ),
        ]);
    }
}
