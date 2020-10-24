<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Currency;
use AvoRed\Framework\System\Requests\CurrencyRequest;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;

class CurrencyController extends Controller
{
    /**
     * Currency Repository.
     * @var \AvoRed\Framework\Database\Repository\CurrencyRepository
     */
    protected $currencyRepository;

    /**
     * Currency Repository.
     * @var \AvoRed\Framework\Database\Repository\CountryRepository
     */
    protected $countryRepository;

    /**
     * Construct for the AvoRed currency controller.
     * @param \AvoRed\Framework\Database\Contracts\CurrencyModelInterface $currencyRepository
     * @param \AvoRed\Framework\Database\Contracts\CountryModelInterface $countryRepository
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $currencies = $this->currencyRepository->paginate();

        return view('avored::system.currency.index')
            ->with(compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tabs = Tab::get('system.currency');
        $currencyCodeOptions = $this->countryRepository->currencyCodeOptions();
        $currencySymbolOptions = $this->countryRepository->currencySymbolOptions();

        return view('avored::system.currency.create')
            ->with(compact('currencySymbolOptions', 'currencyCodeOptions', 'tabs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\CurrencyRequest $request
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\View\View
     */
    public function edit(Currency $currency)
    {
        $tabs = Tab::get('system.currency');
        $currencyCodeOptions = $this->countryRepository->currencyCodeOptions();
        $currencySymbolOptions = $this->countryRepository->currencySymbolOptions();

        return view('avored::system.currency.edit')
            ->with(compact('currency', 'currencySymbolOptions', 'currencyCodeOptions', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\CurrencyRequest $request
     * @param \AvoRed\Framework\Database\Models\Currency  $currency
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return response()->json([
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => __('avored::system.currency.title')]),
        ]);
    }

    
    /**
     * Filter for Category Table.
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        return $this->currencyRepository->filter($request->get('filter'));
    }
}
