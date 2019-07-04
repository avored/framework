<?php

namespace AvoRed\Framework\Cart;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Cart\CartProduct;

class Manager
{
    /**
     * Product Repository.
     * @var \AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * Cart Product collection.
     * @var \Illuminate\Support\Collection
     */
    protected $cartCollection;

    /**
     * AvoRed Cart Session Manager.
     * @var \Illuminate\Session\SessionManager
     */
    public $sessionManager;

    /**
     * Cart Manager Construct.
     * @var \Illuminate\Session\SessionManager
     */
    public function __construct(SessionManager $manager)
    {
        $this->productRepository = app(ProductModelInterface::class);
        $this->sessionManager = $manager;
        $this->cartCollection = $this->getSession();
    }

    /**
     * Add Product to Cart By Given Slug.
     * @param string $slug
     * @param int $qty
     * @return void
     */
    public function add(string $slug, $qty = 1)
    {

        if ($this->getSession()->has($slug)) {
            $cartProduct = $this->cartCollection->get($slug);

            $existingQty = $cartProduct->qty() ?? 0;

            $cartProduct->qty($qty + $existingQty);
            $this->cartCollection->put($slug, $cartProduct);
            $this->updateSessionCollection();
        } else {
            $cartProduct = $this->createCartProductFromSlug($slug);
            $cartProduct->qty($qty);
            
            $this->cartCollection->put($slug, $cartProduct);
            $this->updateSessionCollection();
        }
    }

    /**
     * Create Cart Product From slug.
     * @param string $slug
     * @return \AvoRed\Framework\Cart\CartProduct $cartProduct
     */
    public function createCartProductFromSlug(string $slug): CartProduct
    {
        $product = $this->productRepository->findBySlug($slug);
        $cartProduct = new CartProduct;
        $cartProduct->name($product->name)
            ->slug($product->slug)
            ->price($product->price)
            ->image($product->main_image_url);

        return $cartProduct;
    }

    /**
     * Clear the All Cart Products.
     * @return void
     */
    public function clear()
    {
        $this->sessionManager->forget($this->getSessionKey());
    }

     /**
     * Get the Current Collection for the Prophetoducts.
     * @return \Illuminate\Support\Collection
     */
    public function getSession()
    {
        $sessionKey = $this->getSessionKey();
        if ($this->sessionManager->has($sessionKey)) {
            return $this->sessionManager->get($sessionKey);
        } else {
            return new Collection;
        }
    }

    /**
     * Get the Session Key for the Session Manager.
     * @return string $sessionKey
     */
    public function getSessionKey()
    {
        return config('avored.cart.session_key') ?? 'cart_products';
    }

    /**
     * Update the Session Collection
     * @return self $this
     */
    protected function updateSessionCollection()
    {
        $this->sessionManager->put($this->getSessionKey(), $this->cartCollection);
        return $this;
    }

    /**
     * Get the List of All the Current Session Cart Products.
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->getSession();
    }
    
    /**
     * Get the List of All the Current Session Cart Products.
     * @return \Illuminate\Support\Collection
     */
    public function toArray()
    {
        $products = $this->all();
        $items = Collection::make([]);
        foreach ($products as $product) {
            $items->push([
                'slug' => $product->slug(),
                'image' => $product->image(),
                'price' => $product->price(),
                'qty' => $product->qty(),
                'name' => $product->name()
            ]);
        }
        return $items;
    }
    
    /**
     * Get the List of All the Current Session Cart Products.
     * @return mixed $cartTotal
     */
    public function total($format = true)
    {
        $products =  $this->all();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->total();
        }

        if ($format === true) {
            return number_format($total, 2);
        }
        return $total;
    }

    /**
     * Get the Total Number of Products into the Cart.
     * @return int $count
     */
    public function count()
    {
        return $this->getSession()->count();
    }
}
