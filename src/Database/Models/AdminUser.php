<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Notifications\Notifiable;
use AvoRed\Framework\User\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class AdminUser extends BaseModel
{
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role_id', 'is_super_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
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
     * Get the full name for the Admin User.
     * @return string $fullName
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    /**
     * Get the full name for the Admin User.
     * @return string $fullName
     */
    public function getImagePathUrlAttribute()
    {
        if (empty($this->imagePath)) {
            return 'https://place-hold.it/250x250';
        }
        return asset('storage' . DIRECTORY_SEPARATOR . $this->imagePath->path);
    }

    /**
     * Get the full name for the Admin User.
     * @return string $fullName
     */
    public function getImagePathNameAttribute()
    {
        return basename($this->image_path);
    }

    /**
     * Set User Password for the Admin User.
     * @param string $password
     * @return void
     */
    public function setPasrdAttribute($val)
    {
        $this->attributes['password'] = Hash::make($val);
    }


    /**
     * To check if user has permission to access the given route name.
     * @return \Illuminate\Database\Eloquent\Collection $permissions
     */
    public function permissions()
    {
        dd($this->role->permissions);
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    /**
     * To check if user has permission to access the given route name.
     * @return bool
     */
    public function hasPermission($routeName): bool
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
     * Get the staff profile image.
     */
    public function imagePath()
    {
        return $this->morphOne(Document::class, 'documentable');
    }
}
