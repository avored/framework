<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AvoRed\Framework\Database\Contracts\StateModelInterface;
use AvoRed\Framework\Database\Models\State;
use AvoRed\Framework\System\Requests\StateRequest;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;

class StateController extends Controller
{
    /**
     * State Repository for the State Controller
     * @var \AvoRed\Framework\Database\Repository\StateRepository $stateRepository
     */
    protected $stateRepository;
    
    /**
     * Country Repository for the State Controller
     * @var \AvoRed\Framework\Database\Repository\CountryRepository $countryRepository
     */
    protected $countryRepository;
    
    /**
     * Construct for the AvoRed state controller
     * @param \AvoRed\Framework\Database\Repository\StateRepository $stateRepository
     */
    public function __construct(
        StateModelInterface $stateRepository,
        CountryModelInterface $countryRepository
    ) {
        $this->stateRepository = $stateRepository;
        $this->countryRepository = $countryRepository;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = $this->stateRepository->all();
        
        return view('avored::system.state.index')
            ->with('states', $states);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryOptions = $this->countryRepository->options();
        return view('avored::system.state.create')
            ->with('countryOptions', $countryOptions);
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\StateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        $this->stateRepository->create($request->all());

        return redirect()->route('admin.state.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::system.state.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\State $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $countryOptions = $this->countryRepository->options();
        return view('avored::system.state.edit')
            ->with('state', $state)
            ->with('countryOptions', $countryOptions);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\StateRequest $request
     * @param \AvoRed\Framework\Database\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        $state->update($request->all());

        return redirect()->route('admin.state.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored:system.state.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();

        return [
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => __('avored:system.state.title')])
        ];
    }
}
