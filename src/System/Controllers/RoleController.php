<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\System\Requests\RoleRequest;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Permission\Permission;
use AvoRed\Framework\Tab\Tab;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{

    /**
     * @var RoleRepository $roleRepository
     */
    protected $roleRepository;
    /**
     *
     * @param RoleRepositroy $repository
     */
    public function __construct(
        RoleModelInterface $repository
    ) {
        $this->roleRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->paginate();

        return view('avored::system.role.index')
        ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $tabs = Tab::get('system.role');

        return view('avored::system.role.create')
            ->with('tabs', $tabs)
            ->with('permissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roleRepository->create($request->all());
        $this->roleRepository->saveRolePermissions($request, $role);

        return redirect(route('admin.role.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $tabs = Tab::get('system.role');

        return view('avored::system.role.edit')
            ->with('role', $role)
            ->with('tabs', $tabs)
            ->with('permissions', $permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest  $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $this->roleRepository->saveRolePermissions($request, $role);

        return redirect(route('admin.role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return new JsonResponse([
            'success' => true,
            'message' => __('avored::system.success_delete_message', ['attribute' => __('avored::system.role')])
        ]);
    }
}
