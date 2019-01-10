<?php

namespace AvoRed\Framework\Cart;

use AvoRed\Framework\Cart\Contracts\Cart as CartContracts;

class Product implements CartContracts
{


    /**
     * Cart Product ID
     *
     * @var
     */
    protected $id;

    /**
     * Cart Product Model
     *
     * @var
     */
    protected $model;

    /**
     * Cart Product Name.
     *
     * @var string
     */
    protected $name;

    /**
     * Cart Product Qty.
     *
     * @var int
     */
    protected $qty;

    /**
     * Cart Product Slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * Cart Product Price.
     *
     * @var float
     */
    protected $price;

    /**
     * Cart Product Tax Amount.
     *
     * @var double
     */
    protected $tax;

    /**
    * Cart Product Attributes.
    *
    * @var array
    */
    protected $attributes;

    /**
     * Cart Product Image.
     *
     * @var string
     */
    protected $image;

    /**
     * Cart Product Line Total.
     *
     * @var double
     */
    protected $lineTotal;



    public function id($id = null)
    {
        if (null === $id)
            return $this->id;

        $this->id = $id;
        return $this;
    }

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
     * @param null|int $qty
     * @return $this|int
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
     * Set/Get Cart Product Tax.
     * @param null|double $amount
     * @return $this|double
     */
    public function tax($amount = null)
    {
        if (null === $amount) {
            return $this->tax;
        }

        $this->tax = $amount;

        return $this;
    }

    /**
     * Set/Get Cart Product Line Total.
     * @param null|double $amount
     * @return $this|double
     */
    public function lineTotal($amount = null)
    {
        if (null === $amount) {
            return $this->lineTotal;
        }

        $this->lineTotal = $amount;

        return $this;
    }

    /**
     * Get Cart Product Formatted Price.
     *
     * @return double
     */
    public function priceFormat()
    {
        return number_format($this->price(), 2, ',', '.');
    }

    /**
     * Get Cart Product Formatted Price.
     *
     * @return double
     */
    public function finalPrice()
    {
        return number_format(($this->price() + $this->tax()) * $this->qty(), 2, ',', '.');
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
    public function attributes($attributes = null)
    {
        if (null === $attributes) {
            return $this->attributes;
        }

        $this->attributes = $attributes;

        return $this;
    }

    /**
     *
     * @param mixed $model
     */
    public function model($model = null)
    {
        if (null === $model)
            return $this->model;

        $this->model = $model;

        return $this;
    }

}
