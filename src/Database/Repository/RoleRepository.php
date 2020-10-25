<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Role;
use Illuminate\Support\Collection as SupportCollection;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class RoleRepository extends BaseRepository implements RoleModelInterface
{
    use FilterTrait;

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
    public function options() : SupportCollection
    {
        return Role::all()->pluck('name', 'id');
    }
}
