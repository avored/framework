<?php
namespace AvoRed\Framework\Cart;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;
use AvoRed\Framework\Repository\Product as ProductRepository;
use Prophecy\Prophet;

class Manager
{
    /**
    * AvoRed Cart Session Manager
    *
    * @var \Illuminate\Session\SessionManager $session
    */
    public $session;

    /**
    * AvoRed Cart Construct
    *
    * @var \Illuminate\Session\SessionManager $session
    */
    public function __construct(SessionManager $manager)
    {
        $this->session = $manager;
        $this->productRepository = new ProductRepository();
    }


    /**
     * Add Product into cart using Slug and Qty
     *
     * @param stirng  $slug
     * @param integer $qty
     * @return \AvoRed\Framework\Cart\Manager $this
     */
    public function add($slug , $qty): Manager {
        $cartProducts = $this->getSession();

        $product = $this->productRepository->getBySlug($slug);

        $cartProduct = new Product();

        $cartProduct->name($product->name)
                    ->qty($qty)
                    ->slug($slug)
                    ->price($product->price)
                    ->image($product->image);


        $cartProducts->put($slug, $cartProduct);

        $this->session->put($this->getSessionKey(), $cartProducts);

        return $this;
    }


    /**
     * Update the Cart Product Qty by Slug
     *
     * @param stirng  $slug
     * @param integer $qty
     * @return \AvoRed\Framework\Cart\Manager $this
     */
    public function update($slug, $qty): Manager {

        $cartProducts = $this->getSession();

        $cartProduct = $cartProducts->get($slug);

        if(null === $cartProduct) {
            throw new \Exception("Cart Product doesn't Exist");
        }
        $cartProduct->qty($qty);


        return $this;
    }


    /**
     * Clear the All Cart Products
     *
     * @return void
     */
    public function clear() {

        $session = $this->getSessionKey();
        $this->session->forget($session);
    }


    /**
     * Remove an Item from Cart Products by Slug
     *
     * @param string $slug
     * @return void
     */
    public function destroy($slug):Manager {

        $cartProducts = $this->getSession();

        $cartProduct = $cartProducts->pull($slug);

        return $this;
    }


    /**
     * Get the Current Collection for the Prophetoducts
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSession() {

        $sessionKey = $this->getSessionKey();

        return $this->session->has($sessionKey) ? $this->session->get($sessionKey) : new Collection;;
    }

    /**
     * Get the Session Key for the Session Manager
     *
     * @return string $sessionKey
     */
    public function getSessionKey() {
        return config('avored-framework.cart.session_key') ?? "cart_products";
    }

    /**
     * Get the List of All the Current Session Cart Products
     *
     * @return \Illuminate\Support\Collection
     */
    public function all() {
        return $this->getSession();
    }

    /**
     * Get the Total Number of Products into the Cart
     *
     * @return integer $count
     */
    public function count() {
        return $this->getSession()->count();
    }
}
