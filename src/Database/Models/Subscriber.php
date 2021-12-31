<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends BaseModel
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'email',
        'status'
    ];

    /**
     * Subscriber Belongs to a Customer Model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
