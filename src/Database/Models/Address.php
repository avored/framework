<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'type',
        'user_id',
        'company_name',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'postcode',
        'city',
        'state',
        'country_id',
        'phone'
    ];
}
