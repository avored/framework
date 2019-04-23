<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Role extends Model
{
    /**
     * Admin Role name Constatnt
     */
    const ADMIN = 'Administrator';
    
     /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * static method for the role option
     * @return \Illuminate\Database\Eloquent\Collection $options
     */
    public static function options($empty = true): Collection
    {
        $model = new static();
        $options = $model->all()->pluck('name', 'id');
        if (true === $empty) {
            $options->prepend('Please Select', null);
        }
        return $options;
    }

    /**
     * A Role can be assigned to many users.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(AdminUser::class);
    }

    /**
     * Role has many Permissions.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * To check if a given permission name a role has it?
     * @param string $permissionName
     * @return bool $hasPermission
     */
    public function hasPermission($permissionName): bool
    {
        $permissions = explode(',', $permissionName);
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if ($this->permissions->pluck('name')->contains($permission) == false) {
                $hasPermission = false;
            }
        }
        return $hasPermission;
    }
}
