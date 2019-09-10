<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Database\Models\TaxGroup;
use AvoRed\Framework\System\Requests\TaxGroupRequest;
use AvoRed\Framework\Database\Contracts\TaxGroupModelInterface;

class TaxGroupController
{
    /**
     * TaxGroup Repository for Controller.
     * @var \AvoRed\Framework\Database\Repository\TaxGroupRepository
     */
    protected $taxGroupRepository;

    /**
     * Construct for the AvoRed tax group controller.
     * @param \AvoRed\Framework\Database\Contracts\TaxGroupModelInterface $taxGroupRepository
     */
    public function __construct(
        TaxGroupModelInterface $taxGroupRepository
    ) {
        $this->taxGroupRepository = $taxGroupRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $taxGroups = $this->taxGroupRepository->all();

        return view('avored::system.tax-group.index')
            ->with(compact('taxGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('avored::system.tax-group.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\TaxGroupRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaxGroupRequest $request)
    {
        $this->taxGroupRepository->create($request->all());

        return redirect()->route('admin.tax-group.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::system.tax-group.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\TaxGroup $taxGroup
     * @return \Illuminate\View\View
     */
    public function edit(TaxGroup $taxGroup)
    {
        return view('avored::system.tax-group.edit')
            ->with(compact('taxGroup'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\TaxGroupRequest $request
     * @param \AvoRed\Framework\Database\Models\TaxGroup  $taxGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaxGroupRequest $request, TaxGroup $taxGroup)
    {
        $taxGroup->update($request->all());

        return redirect()->route('admin.tax-group.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::system.tax-group.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\TaxGroup  $taxGroup
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TaxGroup $taxGroup)
    {
        $taxGroup->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::system.tax-group.title')]
            ),
        ]);
    }
}
