<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class OrderStatus extends Model
{
     /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'is_default'];

    /**
     * Set the Default value for the Order Status
     * @param int $val
     * @return void
     */
    protected function setIsDefaultAttribute($val)
    {
        if ($val === null) {
            $this->attributes ['is_default'] = 0;
        }
    }
}
