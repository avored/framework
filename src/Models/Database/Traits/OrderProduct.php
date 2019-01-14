<?php
/**
 * Created by PhpStorm.
 * User: ludio
 * Date: 10/01/19
 * Time: 19:08
 */

namespace AvoRed\Framework\Models\Database\Traits;


trait OrderProduct
{
    public function calculateTotalProducts($products = null)
    {
        $total = 0;
        if ($products == null) {
            $products = $this->products;
        }

        foreach ($products as $product) {
            $total += $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty;
        }

        return $total;
    }

    public function getTotalOrderValueAttribute()
    {
        return $this->calculateTotalProducts();
    }
}
