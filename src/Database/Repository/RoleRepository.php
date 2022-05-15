<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Contracts\PermissionModelInterface;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Models\Role;
use Illuminate\Support\Collection as SupportCollection;

class RoleRepository extends BaseRepository implements RoleModelInterface
{
    /**
     * Filterable Fields
     * @var array
     */
    protected $filterFields = [
        'name',
    ];

    protected $model;

    public function __construct()
    {
        $this->model = new Role();
    }

    public function model()
    {
        return $this->model;
    }

    public function findAdminRole(): Role
    {
        return Role::whereName(Role::ADMIN)->first();
    }

    public function options(): SupportCollection
    {
        return Role::all()->pluck('name', 'id');
    }

    // public function saveRolePermissions($request, $role)
    // {
    //     $permissionIds = SupportCollection::make([]);

    //     if ($request->get('permissions') !== null && count($request->get('permissions')) > 0) {
    //         foreach ($request->get('permissions') as $key => $value) {
    //             if ($value != 1) {
    //                 continue;
    //             }
    //             $permissions = explode(',', $key);
    //             foreach ($permissions as $permissionName) {
    //                 $permissionRepository = app(PermissionModelInterface::class);
    //                 $permissionModel = $permissionRepository->findByName($permissionName);
    //                 if ($permissionModel === null) {
    //                     $permissionModel = $permissionRepository->create(['name' => $permissionName]);
    //                 }
    //                 $permissionIds->push($permissionModel->id);
    //             }
    //         }
    //         $ids = $permissionIds->unique();
    //         $role->permissions()->sync($ids);
    //     }
    // }
}
