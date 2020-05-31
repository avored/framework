<?php

namespace AvoRed\Framework\Database\Models;

class Role extends BaseModel
{
    /**
     * Admin Role name Constatnt.
     */
    const ADMIN = 'Administrator';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'description'];

    public function hasPermission($routes)
    {
        $modelPermissions = $this->permissions->pluck('name');
        $permissions = explode(',', $routes);
        $hasPermission = true;

        foreach ($permissions as $permissions) {
            if (! $modelPermissions->contains($permissions)) {
                $hasPermission = false;
            }
        }

        return $hasPermission;
    }

    /**
     * Role has many Permissions.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
