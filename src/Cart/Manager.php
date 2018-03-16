<?php
namespace AvoRed\Framework\Cart;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;
use AvoRed\Framework\Repository\Product as ProductRepository;

class Manager
{
    public $session;

    public function __construct(SessionManager $manager)
    {
        $this->session = $manager;
        $this->productRepository = new ProductRepository();
    }


    /**
     *
     * @param array $productDetails
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
     * @param \AvoRed\Framework\Cart\Manager $this
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



    public function getSession() {

        $sessionKey = $this->getSessionKey();

        return $this->session->has($sessionKey) ? $this->session->get($sessionKey) : new Collection;;
    }

    public function getSessionKey() {
        return config('avored-framework.cart.session_key') ?? "cart_products";
    }

    public function all() {
        return $this->getSession();
    }

    public function count() {

        return $this->getSession()->count();
    }
}
