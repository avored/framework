<?php

namespace AvoRed\Framework\Cart;

use AvoRed\Ecommerce\Repository\Config;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use AvoRed\Framework\Repository\Product as ProductRepository;

class Manager
{
    /**
     * AvoRed Cart Session Manager.
     *
     * @var \Illuminate\Session\SessionManager
     */
    public $session;

    /**
     * AvoRed Cart Construct.
     *
     * @var \Illuminate\Session\SessionManager
     */
    public function __construct(SessionManager $manager)
    {
        $this->session = $manager;
        $this->productRepository = new ProductRepository();
    }

    /**
     * Add Product into cart using Slug and Qty.
     *
     * @param stirng  $slug
     * @param int $qty
     * @return \AvoRed\Framework\Cart\Manager $this
     */
    public function add($slug, $qty): Manager
    {
        $cartProducts = $this->getSession();

        $product = $this->productRepository->getBySlug($slug);

        $cartProduct = new Product();

        $cartProduct->name($product->name)
                    ->qty($qty)
                    ->slug($slug)
                    ->price($product->price)
                    ->image($product->image)
                    ->lineTotal($qty * $product->price);

        $cartProducts->put($slug, $cartProduct);

        $this->session->put($this->getSessionKey(), $cartProducts);

        return $this;
    }

    /**
     * Update the Cart Product Qty by Slug.
     *
     * @param stirng  $slug
     * @param int $qty
     * @return \AvoRed\Framework\Cart\Manager $this
     */
    public function update($slug, $qty): Manager
    {
        $cartProducts = $this->getSession();

        $cartProduct = $cartProducts->get($slug);

        if (null === $cartProduct) {
            throw new \Exception("Cart Product doesn't Exist");
        }
        $cartProduct->qty($qty);
        $cartProduct->lineTotal($qty * $cartProduct->price());

        return $this;
    }

    /**
     * Update the Cart Product Qty by Slug.
     *
     * @param stirng    $slug
     * @param float     $amount
     * @return \AvoRed\Framework\Cart\Manager $this
     */
    public function updateProductTax($slug, $amount): Manager
    {
        $cartProducts = $this->getSession();

        $cartProduct = $cartProducts->get($slug);

        if (null === $cartProduct) {
            throw new \Exception("Cart Product doesn't Exist");
        }
        $cartProduct->tax($amount);

        $cartProduct->lineTotal($cartProduct->qty() * $cartProduct->price() + $amount);

        return $this;
    }

    /**
     * Clear the All Cart Products.
     *
     * @return void
     */
    public function clear()
    {
        $session = $this->getSessionKey();
        $this->session->forget($session);
    }

    /**
     * Remove an Item from Cart Products by Slug.
     *
     * @param string $slug
     * @return void
     */
    public function destroy($slug):Manager
    {
        $cartProducts = $this->getSession();

        $cartProduct = $cartProducts->pull($slug);

        return $this;
    }

    /**
     * Set/Get Cart has Tax.
     * @param null|boolean $flag
     * @return $this|boolean
     */
    public function hasTax($flag = null)
    {

        if (null === $flag) {
            return $this->session->get('hasTax');
        }

        $this->session->put('hasTax',$flag);

        return $this;
    }

    /**
     * Get the Current Collection for the Prophetoducts.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSession()
    {
        $sessionKey = $this->getSessionKey();

        return $this->session->has($sessionKey) ? $this->session->get($sessionKey) : new Collection;
    }

    /**
     * Get the Current Cart Total
     *
     * @return float $total
     */
    public function total()
    {
        $total = 0.00;
        $cartProducts = $this->getSession();
        foreach ($cartProducts as $product) {
            $total += $product->lineTotal();
        }

        return $total;
    }


    /**
     * Get the Current Cart Tax Total
     *
     * @return float $taxTotal
     */
    public function taxTotal()
    {
        $taxTotal = 0.00;
        $cartProducts = $this->getSession();
        foreach ($cartProducts as $product) {
            $taxTotal += $product->tax();
        }

        return $taxTotal;
    }

    /**
     * Get the Session Key for the Session Manager.
     *
     * @return string $sessionKey
     */
    public function getSessionKey()
    {
        return config('avored-framework.cart.session_key') ?? 'cart_products';
    }

    /**
     * Get the List of All the Current Session Cart Products.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->getSession();
    }

    /**
     * Get the Total Number of Products into the Cart.
     *
     * @return int $count
     */
    public function count()
    {
        return $this->getSession()->count();
    }
}
