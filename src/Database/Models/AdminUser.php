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

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'is_super_admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'image_path_url', 'image_path_name',
    ];

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ResetPassword($token));
    // }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function getImagePathUrlAttribute()
    {
        if (empty($this->imagePath)) {
            return 'https://place-hold.it/250x250';
        }
        return asset('storage' . DIRECTORY_SEPARATOR . $this->imagePath->path);
    }

    public function getImagePathNameAttribute()
    {
        return basename($this->image_path);
    }

    public function setPasrdAttribute($val)
    {
        $this->attributes['password'] = Hash::make($val);
    }

    // public function permissions()
    // {
    //     dd($this->role->permissions);
    // }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // public function hasPermission($routeName): bool
    // {
    //     if ($this->is_super_admin) {
    //         return true;
    //     }
    //     $role = $this->role;
    //     if ($role->permissions->pluck('name')->contains($routeName) == false) {
    //         return false;
    //     }

    //     return true;
    // }

    // public function imagePath()
    // {
    //     return $this->morphOne(Document::class, 'documentable');
    // }
}
