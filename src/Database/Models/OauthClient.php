<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Client;
use Ramsey\Uuid\Uuid;

class OauthClient extends Client
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'secret', 'provider', 'redirect', 'personal_access_client', 'password_client', 'revoked'
    ];


    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function (Model $model) {
            $model->setAttribute('id', Uuid::uuid4()->toString());
        });
    }
}
