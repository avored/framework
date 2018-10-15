<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\System\DataGrid\RoleDataGrid;
use AvoRed\Framework\Models\Database\Role as Model;
use AvoRed\Framework\User\Requests\RoleRequst;
use AvoRed\Framework\Models\Database\Permission;
use AvoRed\Framework\Models\Contracts\RoleInterface;
use AvoRed\Framework\Models\Database\Role;

class RoleController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\RoleRepository
     */
    protected $repository;

    public function __construct(RoleInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleGrid = new RoleDataGrid($this->repository->query());

        return view('avored-framework::system.role.index')->with('dataGrid', $roleGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::system.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Framework\User\Requests\RoleRequst $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequst $request)
    {
        try {
            $role = $this->repository->create($request->all());
            $this->_saveRolePermissions($request, $role);
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return redirect()->route('admin.role.index')->with('notificationText', ' New Role has been Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\Role $role
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $role)
    {
        return view('avored-framework::system.role.edit')
            ->with('model', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\User\Requests\RoleRequst $request
     * @param \AvoRed\Framework\Models\Database\Role $role
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequst $request, Model $role)
    {
        try {
            $role->update($request->all());
            $this->_saveRolePermissions($request, $role);
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return redirect()->route('admin.role.index')->with('notificationText', ' Role Updates Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \AvoRed\Framework\Models\Database\Role $role
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $role)
    {
        $role->delete();
        return redirect()->route('admin.role.index')->with('notificationText', ' Role Destroy Successfully!');
    }

    /**
     * Save Role Permission for the Users
     *
     * @param \AvoRed\Framework\User\Requests\RoleRequst $request
     * @param \AvoRed\Framework\Models\Database\Role $rolet
     *
     * @return void
     */
    private function _saveRolePermissions($request, $role)
    {
        $permissionIds = [];

        if (count($request->get('permissions')) > 0) {
            foreach ($request->get('permissions') as $key => $value) {
                if ($value != 1) {
                    continue;
                }
                $permissions = explode(',', $key);
                foreach ($permissions as $permissionName) {
                    if (null === ($permissionModel = Permission::getPermissionByName($permissionName))) {
                        $permissionModel = Permission::create(['name' => $permissionName]);
                    }
                    $permissionIds[] = $permissionModel->id;
                }
            }
        }
        $ids = array_unique($permissionIds);
        $role->permissions()->sync($ids);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('avored-framework::system.role.show')->with('role', $role);
    }
}
