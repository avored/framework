<?php

namespace AvoRed\Framework\Database\Models;

use AvoRed\Framework\User\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role_id', 'is_super_admin', 'image_path',
    ];

    /**
     * The attributes that should be hidden for arrays
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays
     * @var array
     */
    protected $appends = [
        'image_path_url', 'image_path_name',
    ];
    
    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Get the full name for the Admin User
     * @return string $fullName
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    /**
     * Get the full name for the Admin User
     * @return string $fullName
     */
    public function getImagePathUrlAttribute()
    {
        return asset('storage/' . $this->attributes['image_path']);
    }

    /**
     * Get the full name for the Admin User
     * @return string $fullName
     */
    public function getImagePathNameAttribute()
    {
        return basename($this->image_path);
    }
    /**
     * Set User Password for the Admin User
     * @param string $password
     * @return void
     */
    public function setPasrdAttribute($val)
    {
        $this->attributes['password'] = bcrypt($val);
    }

    /**
     * To check if user has permission to access the given route name
     * @return bool
     */
    public function hasPermission($routeName)
    {
        if ($this->is_super_admin) {
            return true;
        }
        $role = $this->role;
        if ($role->permissions->pluck('name')->contains($routeName) == false) {
            return false;
        }
        return true;
    }

    /**
     * To check if user has permission to access the given route name
     * @return \Illuminate\Database\Eloquent\Collection $permissions
     */
    public function permissions()
    {
        dd($this->role->permissions);
    }

    /**
     *
     *
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
