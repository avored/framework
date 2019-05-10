<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Contracts\PermissionModelInterface;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\System\Requests\RoleRequest;
use AvoRed\Framework\Support\Facades\Permission;

class RoleController extends Controller
{
    /**
     * Role Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\RoleRepository $roleRepository
     */
    protected $roleRepository;

    /**
     * Permission Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\PermissionRepository $permissionRepository
     */
    protected $permissionRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Repository\RoleRepository $roleRepository
     */
    public function __construct(
        RoleModelInterface $roleRepository,
        PermissionModelInterface $permissionRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->all();
        
        return view('avored::system.role.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('avored::system.role.create')
            ->with('permissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roleRepository->create($request->all());
        $this->saveRolePermissions($request, $role);
        
        return redirect()->route('admin.role.index')
            ->with('successNotification', __('avored::system.notification.store', ['attribute' => 'Role']));
    }

    /**
     * Display the specified resource.
     * @param  \AvoRed\Framework\Database\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('avored::system.role.edit')
            ->with('role', $role)
            ->with('permissions', $permissions);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\RoleRequest $request
     * @param \AvoRed\Framework\Database\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $this->saveRolePermissions($request, $role);
        
        return redirect()->route('admin.role.index')
            ->with('successNotification', __('avored::system.notification.updated', ['attribute' => 'Role']));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return [
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => 'Role'])
        ];
    }


    /**
     * Save Role Permission for the Users
     * @param \AvoRed\Framework\System\Requests\RoleRequest $request
     * @param \AvoRed\Framework\Models\Database\Role $rolet
     *
     * @return void
     */
    private function saveRolePermissions($request, $role)
    {
        $permissionIds = [];
        
        if (count($request->get('permissions')) > 0) {
            foreach ($request->get('permissions') as $key => $value) {
                if ($value != 1) {
                    continue;
                }
                $permissions = explode(',', $key);
                foreach ($permissions as $permissionName) {
                    if (null === ($permissionModel = $this->permissionRepository->findByName($permissionName))) {
                        $permissionModel = $this->permissionRepository->create(['name' => $permissionName]);
                    }
                    $permissionIds[] = $permissionModel->id;
                }
            }
        }
        $ids = array_unique($permissionIds);
        $role->permissions()->sync($ids);
    }
}
