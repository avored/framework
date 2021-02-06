<?php

namespace AvoRed\Framework\Database\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use AvoRed\Framework\User\Notifications\CustomerResetPassword;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\ClientRepository;

class Customer extends BaseModel
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'image_path',
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
        $this->notify(new CustomerResetPassword($token));
    }

    /**
     * Get the full name for the Admin User.
     * @return string $fullName
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'].' '.$this->attributes['last_name'];
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
        return asset('storage/'.$this->attributes['image_path']);
    }

    /**
     * Get the full name for the Admin User.
     * @return string $fullName
     */
    public function getImagePathNameAttribute()
    {
        return basename($this->image_path);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    /**
     * To check if user has permission to access the given route name.
     * @return bool
     */
    public function hasPermission($routeName) : bool
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
     * Get the Passport Client for User and If it doesnot exist then create a new one
     * @return \Laravel\Passport\Client $client
     */
    public function getPassportClient()
    {
        $client = $this->clients->first();
        if (null === $client) {
            $clientRepository = app(ClientRepository::class);
            $redirectUri = asset('');
            $client = $clientRepository->createPasswordGrantClient($this->id, $this->full_name, $redirectUri);
        }
        
        return $client;
    }
    
    /**
     * To check if user has permission to access the given route name.
     * @return \Illuminate\Database\Eloquent\Collection $permissions
     */
    public function permissions()
    {
        dd($this->role->permissions);
    }

    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the order comments.
     */
    public function orderComments()
    {
        return $this->morphMany(OrderComment::class, 'commentable');
    }
}
