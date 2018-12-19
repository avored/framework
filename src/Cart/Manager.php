<?php

namespace AvoRed\Framework\Cart;

use AvoRed\Framework\Cart\Product as CartFacadeProduct;
use AvoRed\Framework\Models\Database\Attribute;
use AvoRed\Framework\Models\Database\ProductAttributeIntegerValue;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Manager
{
    /**
     * AvoRed Cart Session Manager.
     *
     * @var \Illuminate\Session\SessionManager
     */
    public $sessionManager;

    /**
     * AvoRed Cart Construct.
     *
     * @var \Illuminate\Session\SessionManager
     */
    public function __construct(SessionManager $manager)
    {
        $this->sessionManager = $manager;
    }

    /**
     * Add Product into cart using Slug and Qty.
     *
     * @param string  $slug
     * @param int $qty
     * @param array $attributes
     * @return \AvoRed\Framework\Cart\Manager $this
     */
    public function add($slug, $qty, $attribute = null): Manager
    {
        $cartProducts = $this->getSession();
        $product = Product::whereSlug($slug)->first();
        $price = $product->price;
        $attributes = null;

        if (null !== $attribute && count($attribute)) {

            foreach ($attribute as $attributeId => $attributeValueId) {
                if ('variation_id' == $attributeId) {
                    continue;
                }
                $variableProduct = Product::find($attribute['variation_id']);
                $attributeModel = Attribute::find($attributeId);

                $productAttributeIntValModel = ProductAttributeIntegerValue::
                    whereAttributeId($attributeId)
                    ->whereProductId($variableProduct->id)
                    ->first();

                $optionModel = $attributeModel
                    ->AttributeDropdownOptions()
                    ->whereId($productAttributeIntValModel->value)
                    ->first();

                $price = $variableProduct->price;
                $attributes[] = [
                    'attribute_id' => $attributeId,
                    'variation_id' => $variableProduct->id,
                    'attribute_dropdown_option_id' => $optionModel->id,
                    'variation_display_text' => $attributeModel->name . ': ' . $optionModel->display_text
                ];
            }
        }

        $cartProduct = new CartFacadeProduct();
        $cartProduct->name($product->name)
                    ->qty($qty)
                    ->slug($slug)
                    ->price($price)
                    ->image($product->image)
                    ->lineTotal($qty * $price)
                    ->attributes($attributes);

        $cartProducts->put($slug, $cartProduct);

        $this->sessionManager->put($this->getSessionKey(), $cartProducts);

        return $this;
    }

    /**
     * Update the Cart Product Qty by Slug.
     *
     * @param string  $slug
     * @param int $qty
     * @param array $attribute
     * @return boolean
     */
    public function canAddToCart($slug, $qty, $attribute = [])
    {
        $cartProducts = $this->getSession();
        $cartProduct = $cartProducts->get($slug);
        $cartQty = $cartProduct ? $cartProduct->qty() : 0;
        $checkQty = $qty;
        
        $product = Product::whereSlug($slug)->first();
        if ($product->hasVariation()) {

            $findVaritationId = false;
            foreach ($attribute['attributes'] as $attributeId => $attributeInfo) {
                if (false === $findVaritationId && (isset($attributeInfo['variation_id']))) {
                    $variationId = $attributeInfo['variation_id'];
                }

            }
            $product = Product::find($variationId);
        }
       
        $productQty = $product->qty; 
        if ($productQty >= $checkQty) {
            return true;
        }

        return false;
    }

    /**
     * Update the Cart Product Qty by Slug.
     *
     * @param string  $slug
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
        $cartProduct->lineTotal($qty * ($cartProduct->price() + $cartProduct->tax()));

        return $this;
    }

    /**
     * Update the Cart Product Qty by Slug.
     *
     * @param string    $slug
     * @param float     $taxAmount
     * @return \AvoRed\Framework\Cart\Manager $this
     */
    public function updateProductTax($slug, $taxAmount): Manager
    {
        $cartProducts = $this->getSession();
        $cartProduct = $cartProducts->get($slug);

        if (null === $cartProduct) {
            throw new \Exception("Cart Product doesn't Exist");
        }

        $cartProduct->tax($taxAmount);
        $cartProduct->lineTotal($cartProduct->qty() * ($cartProduct->price() + $taxAmount));

        return $this;
    }

    /**
     * Clear the All Cart Products.
     *
     * @return void
     */
    public function clear()
    {
        $this->sessionManager->forget($this->getSessionKey());
    }

    /**
     * Remove an Item from Cart Products by Slug.
     *
     * @param string $slug
     * @return self $this
     */
    public function destroy($slug):Manager
    {
        $cartProducts = $this->getSession();
        $cartProducts->pull($slug);

        return $this;
    }

    /**
     * Set/Get Cart has Tax.
     * @param null|boolean $flag
     * @return $this|boolean $hasTax
     */
    public function hasTax($flag = null)
    {
        if (null === $flag) {
            return $this->sessionManager->get('hasTax');
        }
        $this->sessionManager->put('hasTax', $flag);
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

        return $this->sessionManager->has($sessionKey) ? $this->sessionManager->get($sessionKey) : new Collection;
    }

    /**
     * Get the Current Cart Total
     *
     * @return double $total
     */
    public function total($formatted = true)
    {
        $total = 0.00;
        $cartProducts = $this->getSession();

        foreach ($cartProducts as $product) {
            $total += $product->lineTotal();
        }

        if ($formatted == true) {
            $symbol = Session::get('currency_symbol');
            return $symbol . number_format($total, 2);
        }

        return $total;
    }

    /**
     * Get the Current Cart Tax Total
     *
     * @return double $taxTotal
     */
    public function taxTotal($formatted = true)
    {
        $taxTotal = 0.00;
        $cartProducts = $this->getSession();
        foreach ($cartProducts as $product) {
            $taxTotal += $product->tax();
        }

        if ($formatted == true) {
            $symbol = Session::get('currency_symbol');
            return  $symbol . number_format($taxTotal, 2);
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
