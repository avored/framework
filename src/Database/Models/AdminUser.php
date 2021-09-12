<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Notifications\Notifiable;
use AvoRed\Framework\User\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class AdminUser extends BaseModel
{
    use Notifiable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role_id', 'is_super_admin', 'image_path',
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
        if ($this->attributes['image_path'] === null) {
            return 'https://placehold.it/250x250';
        }
        return asset('storage/' . $this->attributes['image_path']);
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
}
