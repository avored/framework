<?php
namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\Database\Contracts\UserGroupModelInterface;
use AvoRed\Framework\Database\Models\UserGroup;
use AvoRed\Framework\User\Requests\UserGroupRequest;

class UserGroupController
{
    /**
     * UserGroup Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\UserGroupRepository $userGroupRepository
     */
    protected $userGroupRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Repository\UserGroupRepository $userGroupRepository
     */
    public function __construct(
        UserGroupModelInterface $userGroupRepository
    ) {
        $this->userGroupRepository = $userGroupRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userGroups = $this->userGroupRepository->all();

        return view('avored::user.user-group.index')
            ->with('userGroups', $userGroups);
    }

     /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored::user.user-group.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\UserGroupRequest $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGroup $userGroup)
    {
        return view('avored::user.user-group.edit')
            ->with('userGroup', $userGroup);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\UserGroupRequest $request
     * @param \AvoRed\Framework\Database\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UserGroupRequest $request, UserGroup $userGroup)
    {
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGroup $userGroup)
    {
        $userGroup->delete();

        return [
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::user.user-group.title')]
            )
        ];
    }
}
