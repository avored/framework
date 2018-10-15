<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\System\DataGrid\StateDataGrid;
use AvoRed\Framework\System\Requests\StateRequest;
use AvoRed\Framework\Models\Database\State;
use AvoRed\Framework\Models\Contracts\StateInterface;
use AvoRed\Framework\Models\Contracts\CountryInterface;

class StateController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\StateRepository
     */
    protected $repository;

    public function __construct(StateInterface $repository)
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
        $dataGrid = new StateDataGrid($this->repository->query()->orderBy('id', 'desc'));

        return view('avored-framework::system.state.index')->with('dataGrid', $dataGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryOptions = $this->_getCountryOptions();

        return view('avored-framework::system.state.create')
            ->with('countryOptions', $countryOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\StateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.state.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\State $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $countryOptions = $this->_getCountryOptions();
        return view('avored-framework::system.state.edit')
                    ->with('model', $state)
                    ->with('countryOptions', $countryOptions);
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\StateRequest $request
     * @param \AvoRed\Framework\Models\Database\State $state
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        $state->update($request->all());

        return redirect()->route('admin.state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \AvoRed\Framework\Models\Database\State $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        return redirect()->route('admin.state.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \AvoRed\Framework\Models\Database\State $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        return view('avored-framework::system.state.show')->with('state', $state);
    }

    /**
     * Get the Country Options for the Country Id Fields
     * @return \Illuminate\Support\Collection
     */
    private function _getCountryOptions()
    {
        $countryRepository = app(CountryInterface::class);
        return $countryRepository->options();
    }
}
