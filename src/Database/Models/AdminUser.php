<?php

namespace AvoRed\Framework\Database\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use AvoRed\Framework\User\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\ClientRepository;

class AdminUser extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role_id', 'is_super_admin', 'image_path',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
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
     * Get the Passport Client for User and If it doesnot exist then create a new one
     * @return \Laravel\Passport\Client $client
     */
    public function getPassportClient()
    {
        $client = $this->clients->first();
        if (null === $client) {
            $clientRepository = app(ClientRepository::class);
            
            $redirectUri = route('home'); // Setup Env Variable for Graphql Admin
            $client = $clientRepository->createPasswordGrantClient($this->id, $this->name, $redirectUri);
        }
        
        return $client;
    }
}
