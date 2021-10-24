<?php

namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\User\Requests\AdminUserRequest;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Document\Document;
use AvoRed\Framework\Tab\Tab;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class StaffController extends Controller
{

    /**
     * @var AdminUserRepository $adminUserRepository
     */
    protected $adminUserRepository;

    /**
     * @var RoleRepository $roleRepository
     */
    protected $roleRepository;

    /**
     *
     * @param AdminUserRepositroy $repository
     * @param RoleRepositroy $roleRepository
     */
    public function __construct(
        AdminUserModelInterface $repository,
        RoleModelInterface $roleRepository
    ) {
        $this->adminUserRepository = $repository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUsers = $this->adminUserRepository->paginate();

        return view('avored::user.staff.index')
            ->with('staffs', $adminUsers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->options();
        $tabs = Tab::get('user.staff');

        return view('avored::user.staff.create')
            ->with('tabs', $tabs)
            ->with('options', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $this->adminUserRepository->create($request->all());

        return redirect(route('admin.staff.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AdminUser  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminUser $staff)
    {
        // dd($staff->image_path_url);
        $roles = $this->roleRepository->options();
        $tabs = Tab::get('user.staff');

        return view('avored::user.staff.edit')
            ->with('staff', $staff)
            ->with('options', $roles)
            ->with('tabs', $tabs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminUserRequest  $request
     * @param AdminUser $staff
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, AdminUser $staff)
    {
        if ($request->file('image_path')) {
            $document = Document::uploadPublicly($request->file('image_path'));
            $staff->imagePath()->updateOrCreate(optional($staff->imagePath)->toArray() ?? [], $document);
        }

        $staff->update($request->all());

        return redirect(route('admin.staff.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AdminUser $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUser $staff)
    {
        $staff->delete();

        return new JsonResponse([
            'success' => true,
            'message' => __('avored::system.success_delete_message', ['attribute' => __('avored::system.staff')])
        ]);
    }
}
