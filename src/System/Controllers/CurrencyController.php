<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;
use AvoRed\Framework\Database\Models\Currency;
use AvoRed\Framework\System\Requests\CurrencyRequest;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;

class CurrencyController extends Controller
{
    /**
     * Currency Repository
     * @var \AvoRed\Framework\Database\Repository\CurrencyRepository $currencyRepository
     */
    protected $currencyRepository;

    /**
     * Currency Repository
     * @var \AvoRed\Framework\Database\Repository\CountryRepository $countryRepository
     */
    protected $countryRepository;
    
    /**
     * Construct for the AvoRCountryncy controller
     * @param \AvoRed\Framework\Database\Repository\CurrencyRepository $currencyRepository
     */
    public function __construct(
        CurrencyModelInterface $currencyRepository,
        CountryModelInterface $countryRepository
    ) {
        $this->currencyRepository = $currencyRepository;
        $this->countryRepository = $countryRepository;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = $this->currencyRepository->all();
        
        return view('avored::system.currency.index')
            ->with('currencies', $currencies);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencyCodeOptions =$this->countryRepository->currencyCodeOptions();
        $currencySymbolOptions =$this->countryRepository->currencySymbolOptions();

        return view('avored::system.currency.create')
            ->with('currencySymbolOptions', $currencySymbolOptions)
            ->with('currencyCodeOptions', $currencyCodeOptions);
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\CurrencyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        $this->currencyRepository->create($request->all());

        return redirect()->route('admin.currency.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::system.currency.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        $currencyCodeOptions =$this->countryRepository->currencyCodeOptions();
        $currencySymbolOptions =$this->countryRepository->currencySymbolOptions();

        return view('avored::system.currency.edit')
            ->with('currency', $currency)
            ->with('currencySymbolOptions', $currencySymbolOptions)
            ->with('currencyCodeOptions', $currencyCodeOptions);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\CurrencyRequest $request
     * @param \AvoRed\Framework\Database\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->all());

        return redirect()->route('admin.currency.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::system.currency.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return [
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => __('avored::system.currency.title')])
        ];
    }
}
