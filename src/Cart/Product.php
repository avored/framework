<?php

namespace AvoRed\Framework\Cart;

use AvoRed\Framework\Cart\Contracts\Cart as CartContracts;

class Product implements CartContracts
{
    /**
     * Cart Product Name.
     *
     * @var null|string
     */
    protected $name;

    /**
     * Cart Product Qty.
     *
     * @var null|int
     */
    protected $qty;

    /**
     * Cart Product Slug.
     *
     * @var null|string
     */
    protected $slug;

    /**
     * Cart Product Price.
     *
     * @var null|float
     */
    protected $price;

    /**
     * Cart Product Image.
     *
     * @var null|string
     */
    protected $image;

    /**
     * Set/Get Cart Product Name.
     *
     * @param null|string $name
     * @return $this|string
     */
    public function name($name = null)
    {
        if (null === $name) {
            return $this->name;
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Set/Get Cart Product Qty.
     * @param null|string $qty
     * @return $this|string
     */
    public function qty($qty = null)
    {
        if (null === $qty) {
            return $this->qty;
        }

        $this->qty = $qty;

        return $this;
    }

    /**
     * Set/Get Cart Product Slug.
     * @param null|string $slug
     * @return $this|string
     */
    public function slug($slug = null)
    {
        if (null === $slug) {
            return $this->slug;
        }

        $this->slug = $slug;

        return $this;
    }

    /**
     * Set/Get Cart Product Price.
     * @param null|float $price
     * @return $this|float
     */
    public function price($price = null)
    {
        if (null === $price) {
            return $this->price;
        }

        $this->price = $price;

        return $this;
    }

    /**
     * Get Cart Product Formatted Price.
     *
     * @return float
     */
    public function priceFormat()
    {
        return number_format($this->price(), 2);
    }

    /**
     * Get Cart Product Formatted Price.
     *
     * @return float
     */
    public function finalPrice()
    {
        return number_format($this->price() * $this->qty(), 2);
    }

    /**
     * Set/Get Cart Product Image.
     *
     * @param null|float $price
     * @return $this|float
     */
    public function image($image = null)
    {
        if (null === $image) {
            return $this->image;
        }

        $this->image = $image;

        return $this;
    }

    /**
     * To Check if Cart Product Has Attributes.
     *
     * @return bool
     */
    public function hasAttributes()
    {
        return false;
    }
}
