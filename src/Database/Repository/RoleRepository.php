<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Contracts\PermissionModelInterface;
use AvoRed\Framework\Database\Models\Role;
use Illuminate\Support\Collection as SupportCollection;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;

class RoleRepository extends BaseRepository implements RoleModelInterface
{
    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
    ];

    /**
     * @var Role $model
     */
    protected $model;

    /**
     * Construct for the Role Repository
     */
    public function __construct()
    {
        $this->model = new Role();
    }

    /**
     * Get the model for the repository
     * @return Role
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Create Role Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Role $role
     */
    public function findAdminRole(): Role
    {
        return Role::whereName(Role::ADMIN)->first();
    }

    /**
     * get role options to use as dropdown options.
     * @return \Illuminate\Support\Collection $roles
     */
    public function options(): SupportCollection
    {
        return Role::all()->pluck('name', 'id');
    }


    /**
     * Save Role Permission for the Users.
     * @param \AvoRed\Framework\System\Requests\RoleRequest $request
     * @param \AvoRed\Framework\Models\Database\Role $rolet
     *
     * @return void
     */
    public function saveRolePermissions($request, $role)
    {
        $permissionIds = SupportCollection::make([]);

        if ($request->get('permissions') !== null && count($request->get('permissions')) > 0) {
            foreach ($request->get('permissions') as $key => $value) {
                if ($value != 1) {
                    continue;
                }
                $permissions = explode(',', $key);
                foreach ($permissions as $permissionName) {
                    $permissionRepository = app(PermissionModelInterface::class);
                    $permissionModel = $permissionRepository->findByName($permissionName);
                    if ($permissionModel === null) {
                        $permissionModel = $permissionRepository->create(['name' => $permissionName]);
                    }
                    $permissionIds->push($permissionModel->id);
                }
            }
            $ids = $permissionIds->unique();
            $role->permissions()->sync($ids);
        }
    }
}
