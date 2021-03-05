<?php

namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\CustomerGroup;
use AvoRed\Framework\User\Requests\CustomerGroupRequest;
use AvoRed\Framework\Database\Contracts\CustomerGroupModelInterface;
use Illuminate\Http\Request;

class CustomerGroupController
{
    /**
     * CustomerGroup Repository for controller.
     * @var \AvoRed\Framework\Database\Repository\CustomerGroupRepository
     */
    protected $customerGroupRepository;

    /**
     * Construct for the AvoRed Customer Group controller.
     * @param \AvoRed\Framework\Database\Contracts\CustomerGroupModelInterface $customerGroupRepository
     */
    public function __construct(
        CustomerGroupModelInterface $customerGroupRepository
    ) {
        $this->customerGroupRepository = $customerGroupRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        $perPage = 10;
        if ($request->has('filter')) {
            $customerGroups = $this->customerGroupRepository->filter($request->get('filter'));
        } else {
            $customerGroups = $this->customerGroupRepository->paginate($perPage);
        }

        return view('avored::user.customer-group.index')
            ->with(compact('customerGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tabs = Tab::get('user.customer-group');

        return view('avored::user.customer-group.create')
            ->with(compact('tabs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\CustomerGroupRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerGroupRequest $request)
    {
        $this->customerGroupRepository->create($request->all());

        return redirect()->route('admin.customer-group.index')
            ->with('successNotification', __(
                'avored::system.created_notification',
                ['attribute' => __('avored::system.customer-group')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\CustomerGroup $customerGroup
     * @return \Illuminate\View\View
     */
    public function edit(CustomerGroup $customerGroup)
    {
        $tabs = Tab::get('user.customer-group');

        return view('avored::user.customer-group.edit')
            ->with(compact('customerGroup', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\CustomerGroupRequest $request
     * @param \AvoRed\Framework\Database\Models\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerGroupRequest $request, CustomerGroup $customerGroup)
    {
        if ($request->get('is_default') && $group = $this->customerGroupRepository->getIsDefault()) {
            $group->update(['is_default' => 0]);
        }

        $customerGroup->name = $request->get('name');
        $customerGroup->is_default = $request->has('is_default') ? 1: 0;

        $customerGroup->save();

        return redirect()->route('admin.customer-group.index')
            ->with('successNotification', __(
                'avored::system.updated_notification',
                ['attribute' => __('avored::system.customer-group')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        CustomerGroup::destroy($id);

        return redirect()
            ->route('admin.customer-group.index')
            ->with([
                'successNotification' => __(
                    'avored::system.deleted_notification',
                    ['attribute' => __('avored::system.customer-group')]
                ),
            ]);
    }
}
