<?php

namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\UserGroup;
use AvoRed\Framework\User\Requests\UserGroupRequest;
use AvoRed\Framework\Database\Contracts\UserGroupModelInterface;

class UserGroupController
{
    /**
     * UserGroup Repository for controller.
     * @var \AvoRed\Framework\Database\Repository\UserGroupRepository
     */
    protected $userGroupRepository;

    /**
     * Construct for the AvoRed user group controller.
     * @param \AvoRed\Framework\Database\Contracts\UserGroupModelInterface $userGroupRepository
     */
    public function __construct(
        UserGroupModelInterface $userGroupRepository
    ) {
        $this->userGroupRepository = $userGroupRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userGroups = $this->userGroupRepository->all();

        return view('avored::user.user-group.index')
            ->with(compact('userGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tabs = Tab::get('user.user-group');

        return view('avored::user.user-group.create')
            ->with(compact('tabs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\UserGroupRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserGroupRequest $request)
    {
        $this->userGroupRepository->create($request->all());

        return redirect()->route('admin.user-group.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::user.user-group.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\UserGroup $userGroup
     * @return \Illuminate\View\View
     */
    public function edit(UserGroup $userGroup)
    {
        $tabs = Tab::get('user.user-group');

        return view('avored::user.user-group.edit')
            ->with(compact('userGroup', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\UserGroupRequest $request
     * @param \AvoRed\Framework\Database\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserGroupRequest $request, UserGroup $userGroup)
    {
        if ($request->get('is_default')) {
            $group = $this->userGroupRepository->getIsDefault();
            $group->update(['is_default' => 0]);
        }

        $userGroup->update($request->all());

        return redirect()->route('admin.user-group.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::user.user-group.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(UserGroup $userGroup)
    {
        $userGroup->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::user.user-group.title')]
            ),
        ]);
    }
}
