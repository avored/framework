<?php

namespace AvoRed\Framework\Cart;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Contracts\AttributeProductValueModelInterface;
use AvoRed\Framework\Database\Contracts\PromotionCodeModelInterface;
use AvoRed\Framework\Database\Models\PromotionCode;

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
     * Promotion Code Repository.
     * @var \AvoRed\Framework\Database\Repository\PromotionCodeRepository
     */
    protected $promotionCodeRepository;

    /**
     * Cart Product collection.
     * @var \Illuminate\Support\Collection
     */
    protected $cartCollection;

    /**
     * Cart totoal discount.
     * @var float $totalDiscount
     */
    protected $totalDiscount = 0.00;

    /**
     * Cart applied coupon list.
     * @var @var \Illuminate\Support\Collection
     */
    protected $promotionList;

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
        $this->promotionCodeRepository = app(PromotionCodeModelInterface::class);
        $this->attributeProductValueRepository = app(AttributeProductValueModelInterface::class);
        $this->sessionManager = $manager;
        $this->promotionList = collect();
        $this->cartCollection = $this->getSession();
    }

    /**
     * Apply Coupon Discount to Cart
     * @param string $code
     * @return mixed
     */
    public function applyCoupon(string $code)
    {
        $promotionModel = $this->promotionCodeRepository->findByCode($code);
        if($promotionModel === null) {
            return;
        }
        $this->promotionList->push($promotionModel);

       
        $message = __('avored::catalog.promotion_code_errot_notification');
        if ($promotionModel->type === PromotionCode::FIXED) {
            $this->totalDiscount = $promotionModel->amount;
            $message = __('avored::catalog.promotion_code_success_notification');
        }
        if ($promotionModel->type === PromotionCode::PERCENTAGE) {
            $this->totalDiscount = $this->total() * $promotionModel->amount / 100;
            $message = __('avored::catalog.promotion_code_success_notification');
        }

      
        $this->sessionManager->put(
            $this->getPromotionKey(),
            ['total' => $this->totalDiscount, 'list' => $this->promotionList]
        );

        return $message;
    }
    
    /**
     * Destroy Product from Cart By Given Slug.
     * @param string $slug
     * @return self
     */
    public function destroy(string $slug)
    {
        $this->cartCollection->pull($slug);
        return $this;
    }
    /**
     * update Product from Cart By Given Slug.
     * @param string $slug
     * @return self
     */
    public function update(string $slug, $qty)
    {
        $product = $this->cartCollection->get($slug);
        $product->qty($qty);

        $this->cartCollection->put($slug, $product);
        $this->updateSessionCollection();
        return $this;
    }
    /**
     * Add Product to Cart By Given Slug.
     * @param string $slug
     * @param int $qty
     * @param array $attributes
     * @return array
     */
    public function add(string $slug, $qty = 1, $attributes = [])
    {
        $status = false;
        $message = '';
        $product = $this->productRepository->findBySlug($slug);


        //If Exist: Get Cart Product Object
        //If Not Exist: Get Cart Product Empty Object
        // Then compare the new Qty here
       
        if (
            $product->type === Product::PRODUCT_TYPES_BASIC &&
            $qty > (float) $product->qty
        ) {
            
            return [false, __('avored::system.notification.not_enough_qty')];
        }

        if ($this->exist($slug)) {
            $cartProduct = $this->cartCollection->get($slug);

            $existingQty = $cartProduct->qty() ?? 0;

            $newQty = $qty + $existingQty;

            if ($newQty > $product->qty) {
                $status = false;
                $message = __('avored::system.notification.not_enough_qty'); 
                
            } else {
                $cartProduct->qty($qty + $existingQty);
                $this->cartCollection->put($slug, $cartProduct);
                $this->updateSessionCollection();
                $status = true;
                $message = __('avored::catalog.cart_success_notification');
            }
        } elseif ($product->type === 'VARIABLE_PRODUCT') {
            if ($attributes === null || count($attributes) <= 0) {
                $status = false;
                $message = __('avored::catalog.cart_variable_product_error_notification');
            } else {
                $attrs = Collection::make([]);
                foreach ($attributes as $valueId) {
                    //@todo fixed ideally this can be multiple if variation has more then one attribute
                    $valueModel = $this->attributeProductValueRepository
                        ->getModelByProductIdAndVariationId($product->id, $valueId)->first();

                    $attributeData = [
                        'attribute_id' => $valueModel->attribute_id,
                        'attribute_name' => $valueModel->attribute->name,
                        'attribute_dropdown_option_id' => $valueModel->attribute_dropdown_option_id,
                        'attribute_dropdown_text' => $valueModel->attributeDropdownOption->display_text,
                        'variation_id' => $valueModel->variation_id,
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
     * To check if the Product Existing in the Cart
     * @param string $slug
     * @return boolean
     */
    protected function exist($slug): bool
    {
        return $this->getSession()->has($slug);
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
     * Get the Session Key for the Session Manager.
     * @return string $sessionKey
     */
    public function getPromotionKey()
    {
        return config('avored.cart.promotion_key') ?? 'cart_discount';
    }

    /**
     * Update the Session Collection.
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
                'attributes' => $product->attributes(),
            ]);
        }

        return $items;
    }

    /**
     * Get the List of All the Current Session Cart Products.
     * @return mixed $cartTotal
     */
    public function discount($format = true)
    {
        $discountSessionData = $this->sessionManager->get($this->getPromotionKey());
        $total = $discountSessionData['total'] ?? 0;

        if ($format === true) {
            return number_format($total, 2);
        }

        return $total;
    }
    /**
     * Get the List of All the Current Session Cart Products.
     * @return mixed $cartTotal
     */
    public function total($format = true)
    {
        $products = $this->all();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->total();
        }
        $total = $total - $this->discount();

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
