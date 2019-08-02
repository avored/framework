<?php

namespace AvoRed\Framework\Cart;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Cart\CartProduct;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Contracts\AttributeProductValueModelInterface;

class Manager
{
    /**
     * Product Repository.
     * @var \AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * Product Repository.
     * @var \AvoRed\Framework\Database\Repository\AttributeProductValueRepository
     */
    protected $attributeProductValueRepository;

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
        $this->attributeProductValueRepository = app(AttributeProductValueModelInterface::class);
        $this->sessionManager = $manager;
        $this->cartCollection = $this->getSession();
    }

    /**
     * Add Product to Cart By Given Slug.
     * @param string $slug
     * @param int $qty
     * @param array $attributes
     * @return void
     */
    public function add(string $slug, $qty = 1, $attributes = [])
    {
        $this->clear();
        $status = false;
        $message = '';
        $product = $this->productRepository->findBySlug($slug);
        if ($this->getSession()->has($slug)) {
            $cartProduct = $this->cartCollection->get($product);
            
            $existingQty = $cartProduct->qty() ?? 0;
            
            $cartProduct->qty($qty + $existingQty);
            $this->cartCollection->put($slug, $cartProduct);
            $this->updateSessionCollection();
            $status = true;
            $message = __('avored::catalog.cart_success_notification');
        } elseif ($product->type === 'VARIABLE_PRODUCT') {
            if ($attributes === null || count($attributes) <= 0) {
                $status = false;
                $message = __('avored::catalog.cart_variable_product_error_notification');
            } else {
                $attrs = Collection::make([]);
                foreach ($attributes as $valueId) {
                    $valueModel = $this->attributeProductValueRepository->find($valueId);

                    $attributeData = [
                        'attribute_id' => $valueModel->attribute_id,
                        'attribute_name' => $valueModel->attribute->name,
                        'attribute_dropdown_option_id' => $valueModel->attribute_dropdown_option_id,
                        'attribute_dropdown_text' => $valueModel->attributeDropdownOption->display_text,
                        'variation_id' => $valueModel->variation_id
                    ];

                    $attrs->push($attributeData);
                }
                $cartProduct = $this->createCartProductFromSlug($product, $attrs);
                $cartProduct->qty($qty);
            
                $this->cartCollection->put($slug, $cartProduct);
                $this->updateSessionCollection();
                $status = true;
                $message = __('avored::catalog.cart_success_notification');
            }
        } else {
            $cartProduct = $this->createCartProductFromSlug($product);
            $cartProduct->qty($qty);
            
            $this->cartCollection->put($slug, $cartProduct);
            $this->updateSessionCollection();
            $status = true;
            $message = __('avored::catalog.cart_success_notification');
        }

        return [$status, $message];
    }

    /**
     * Create Cart Product From slug.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param mixed $attributes
     * @return \AvoRed\Framework\Cart\CartProduct $cartProduct
     */
    public function createCartProductFromSlug(Product $product, $attributes = null): CartProduct
    {
        $cartProduct = new CartProduct;

        $cartProduct->name($product->name)
            ->id($product->id)
            ->slug($product->slug)
            ->price($product->getPrice())
            ->taxAmount($product->getTaxAmount())
            ->attributes($attributes ?? [])
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
                'name' => $product->name(),
                'tax' => $product->taxAmount(),
                'attributes' => $product->attributes()
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
