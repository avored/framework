<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\System\DataGrid\CountryDataGrid;
use AvoRed\Framework\Models\Database\Country;
use AvoRed\Framework\System\Requests\CountryRequest;
use AvoRed\Framework\Models\Contracts\CountryInterface;
use Illuminate\Support\Collection;

class CountryController extends Controller
{
    /**
     *
     * @param \Illuminate\Support\Collection $isActiveOptions
     */
    protected $isActiveOptions;
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\CountryRepository
     */
    protected $repository;

    public function __construct(CountryInterface $repository)
    {
        $this->repository = $repository;
        $this->isActiveOptions = Collection::make([['id' => 0, 'name' => 'No'], ['id' => 1, 'name' => 'Yes']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = new CountryDataGrid($this->repository->query()->orderBy('id', 'desc'));

        return view('avored-framework::system.country.index')->with('dataGrid', $dataGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::system.country.create')
                ->with('isActiveOptions', $this->isActiveOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\CountryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.country.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\Country $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('avored-framework::system.country.edit')
                    ->with('model', $country)
                    ->with('isActiveOptions', $this->isActiveOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\CountryRequest $request
     * @param \AvoRed\Framework\Models\Database\Country $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->all());

        return redirect()->route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \AvoRed\Framework\Models\Database\Country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('admin.country.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \AvoRed\Framework\Models\Database\Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('avored-framework::system.country.show')->with('country', $country);
    }
}
