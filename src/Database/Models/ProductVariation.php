<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class ProductVariation extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['product_id', 'variation_id'];

    /**
     * Appended attribute for the model
     * @var array $appends
     */
    protected $appends =  ['variationModel'];

    /**
     * Get the Productfor Select
     * @return \AvoRed\Framework\Database\Models\Product
     */
    public function getVariationModelAttribute()
    {
        return $this->variation;
    }


    /**
     * Property has many datetime value
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variation()
    {
        return $this->belongsTo(Product::class, 'variation_id');
    }
}
