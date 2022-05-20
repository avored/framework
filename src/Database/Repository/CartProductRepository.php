<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\CartProduct;
use AvoRed\Framework\Database\Contracts\CartProductModelInterface;

class CartProductRepository extends BaseRepository implements CartProductModelInterface
{
    /**
     * @var CartProduct $model
     */
    protected $model;

    /**
     * Construct for the CartProduct Repository
     */
    public function __construct()
    {
        $this->model = new CartProduct();
    }

    /**
     * Get the model for the repository
     * @return CartProduct
     */
    public function model(): CartProduct
    {
        return $this->model;
    }
}
