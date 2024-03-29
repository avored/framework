<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\ClientRepository;
class CartProduct extends BaseModel
{
    /**
     * @var string WAITING_TO_BE_PLACED_ORDER
     */
    const WAITING_TO_BE_PLACED_ORDER = 1;

    /**
     * @var string PLACED_ORDER
     */
    const PLACED_ORDER = 2;

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     * @var array
     */

    protected $fillable = [
        'visitor_id',
        'product_id',
        'qty',
        'status'
    ];

    /**
     * CartProduct Belongs to a  product.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * CartProduct Belongs to a  product.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'visitor_id');
    }
}
