<?php

namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\System\Controllers\Controller;
use AvoRed\Framework\Models\Contracts\UserInterface;
use AvoRed\Framework\User\DataGrid\UserDataGrid;
use AvoRed\Framework\User\Requests\UserRequest;
use AvoRed\Framework\Models\Contracts\OrderInterface;
use AvoRed\Framework\User\DataGrid\UserOrderDataGrid;
use AvoRed\Framework\User\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Mail;
use AvoRed\Framework\User\Mail\ChangePasswordMail;

class UserController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\UserRepository
     */
    protected $repository;

    public function __construct(UserInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dataGrid = new UserDataGrid($this->repository->query());

        return view('avored-framework::user.user.index')->with('dataGrid', $dataGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('avored-framework::user.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Framework\Http\Requests\AdminUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $this->repository->create($request->all());
        $this->_syncUserGroups($user, $request->get('user_group_id'));
        return redirect()->route('admin.user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\User $user
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('avored-framework::user.user.edit')
            ->with('model', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\User\Requests\UserRequest $request
     * @param AvoRed\Framework\Models\Database\User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        $this->_syncUserGroups($user, $request->get('user_group_id'));
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvoRed\Framework\Models\Database\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \AvoRed\Framework\Models\Database\User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        $orderRepository = app(OrderInterface::class);

        $userOrders = $orderRepository->query()->whereUserId($user->id);
        $dataGrid = new UserOrderDataGrid($userOrders);
        return view('avored-framework::user.user.show')
            ->with('user', $user)
            ->with('userOrderDataGrid', $dataGrid->dataGrid);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \AvoRed\Framework\Models\Database\User $user
     * @return \Illuminate\View\View
     */
    public function changePasswordGet(User $user)
    {
        return view('avored-framework::user.user.change-password')
            ->with('user', $user);
    }

    /**
     * Update the specified User Password in storage.
     *
     * @param \AvoRed\Framework\User\Requests\ChnagePasswordRequest $request
     * @param \AvoRed\Framework\Models\Database\User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePasswordUpdate(ChangePasswordRequest $request, User $user)
    {
        $password = $request->get('password');
        $user->update(['password' => bcrypt($password)]);
        Mail::to($user->email)->send(new ChangePasswordMail($user, $password));

        return redirect()->route('admin.user.index');
    }

    /**
     * User Group Sync with User Model
     *
     * @param \AvoRed\Framework\Models\Database\User $user
     * @param array $userGroupIds
     * @return void
     */
    private function _syncUserGroups($user, $userGroupIds)
    {
        $user->userGroups()->sync($userGroupIds);
    }
}
