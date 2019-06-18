<?php

namespace AvoRed\Framework\Cart;

use Illuminate\Support\Collection;
use AvoRed\Framework\Support\Contracts\CartProductInterface;

class CartProduct implements CartProductInterface
{
    /**
     * Cart Product Name
     * @var string $name
     */
    protected $name;

    /**
     * Cart Product Slug
     * @var string $slug
     */
    protected $slug;

    /**
     * Cart Product Qty
     * @var int $qty
     */
    protected $qty;

    /**
     * Cart Product Price
     * @var int $price
     */
    protected $price;

    

    /**
     * Set/Get Cart Product Name
     * @param mixed $name
     * @return mixed $name
     */
    public function name($name = null)
    {
        if ($name === null) {
            return $this->name;
        } else {
            $this->name = $name;
            return $this;
        }
    }

    /**
     * Set/Get Cart Product Slug
     * @param mixed $slug
     * @return mixed $slug
     */
    public function slug($slug = null)
    {
        if ($slug === null) {
            return $this->slug;
        } else {
            $this->slug = $slug;
            return $this;
        }
    }

    /**
     * Set/Get Cart Product Qty
     * @param mixed $qty
     * @return mixed $qty
     */
    public function qty($qty = null)
    {
        if ($qty === null) {
            return $this->qty;
        } else {
            $this->qty = $qty;
            return $this;
        }
    }

    /**
     * Set/Get Cart Product Price
     * @param mixed $price
     * @return mixed $price
     */
    public function price($price = null)
    {
        if ($price === null) {
            return $this->price;
        } else {
            $this->price = $price;
            return $this;
        }
    }

    /**
     * Get Cart Product Totla
     * @return float $total
     */
    public function total(): float
    {
        return $this->qty * $this->price;
    }
}
