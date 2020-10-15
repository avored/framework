<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Contracts\ProductImageModelInterface;
use AvoRed\Framework\Database\Models\ProductImage;

class ProductImageRepository extends BaseRepository implements ProductImageModelInterface
{
    /**
     * 
     * @var \AvoRed\Framework\Database\Models\Product $model
     */
    protected $model;

    /**
     * Construct for the Produdct Repository
     * 
     */
    public function __construct()
    {
        $this->model = new ProductImage();   
    }


    /**
     * Model object for the repository
     * @return \AvoRed\Framework\Database\Models\Product $model
     */
    public function model()
    {
        return $this->model;
    }
}
