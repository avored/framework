<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\State;
use AvoRed\Framework\System\Requests\StateRequest;
use AvoRed\Framework\Database\Contracts\StateModelInterface;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;

class StateController extends Controller
{
    /**
     * State Repository for the State Controller.
     * @var \AvoRed\Framework\Database\Repository\StateRepository
     */
    protected $stateRepository;

    /**
     * Country Repository for the State Controller.
     * @var \AvoRed\Framework\Database\Repository\CountryRepository
     */
    protected $countryRepository;

    /**
     * Construct for the AvoRed state controller.
     * @param \AvoRed\Framework\Database\Contracts\StateModelInterface $stateRepository
     * @param \AvoRed\Framework\Database\Contracts\CountryModelInterface $countryRepository
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $states = $this->stateRepository->all();

        return view('avored::system.state.index')
            ->with(compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tabs = Tab::get('system.state');
        $countryOptions = $this->countryRepository->options();

        return view('avored::system.state.create')
            ->with(compact('countryOptions', 'tabs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\StateRequest $request
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\View\View
     */
    public function edit(State $state)
    {
        $tabs = Tab::get('system.state');
        $countryOptions = $this->countryRepository->options();

        return view('avored::system.state.edit')
            ->with(compact('state', 'countryOptions', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\StateRequest $request
     * @param \AvoRed\Framework\Database\Models\State  $state
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(State $state)
    {
        $state->delete();

        return response()->json([
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => __('avored:system.state.title')]),
        ]);
    }
}
