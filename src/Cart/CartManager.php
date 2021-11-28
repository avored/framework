<?php

namespace AvoRed\Framework\Cart;

use AvoRed\Framework\Database\Contracts\CartProductModelInterface;
use Illuminate\Support\Collection;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Contracts\AttributeProductValueModelInterface;
use AvoRed\Framework\Database\Contracts\PromotionCodeModelInterface;
use AvoRed\Framework\Database\Models\PromotionCode;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Database\Models\CartProduct;

class CartManager
{
    /**
     * Visitor
     * @var \AvoRed\Framework\Database\Model\Visitor
     */
    protected $visitor;

    /**
     * Product Repository.
     * @var \AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * Cart Product Repository.
     * @var \AvoRed\Framework\Database\Repository\CartProductRepository
     */
    protected $cartProductRepository;

    /**
     * Cart Product collection.
     * @var \Illuminate\Support\Collection
     */
    protected $cartCollection;

    /**
     * Cart Manager Construct.
     */
    public function __construct(
        ProductModelInterface $productRepository,
        CartProductModelInterface  $cartProductRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->cartProductRepository = $cartProductRepository;
        $this->visitor = Auth::guard('visitor_api')->user();
    }

    /**
     * Destroy Product from Cart By Given Slug.
     * @param string $slug
     * @return self
     */
    public function destroy(string $slug)
    {
        $product = $this->getProductBySlug($slug);
        $visitor = Auth::guard('visitor_api')->user();

        $this->cartProductRepository->query()->where('product_id', $product->id)->delete();
    }
    /**
     * update Product from Cart By Given Slug.
     * @param string $slug
     * @return self
     */
    public function update(string $slug, $qty)
    {

        return $this;
    }
    /**
     * Add Product to Cart By Given Slug.
     * @param string $slug
     * @param int $qty
     * @param array $attributes
     * @return CartProduct
     */
    public function add(string $slug, float $qty = 1, array $attributes = []): CartProduct
    {
        /** @var Product $product  */
        $product = $this->productRepository->findBySlug($slug);
        $cartProduct = $this->getCartProduct($product->id);

        if ($cartProduct !== null) {
            $cartProduct->qty = $cartProduct->qty + $qty;
            $cartProduct->save();
        } else {
            $data = [
                'visitor_id' => $this->visitor->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'qty' => $qty
            ];
            $cartProduct = $this->cartProductRepository->create($data);
        }
        return $cartProduct;
    }

    public function getProductBySlug(string $slug): Product
    {
        return $this->productRepository->findBySlug($slug);
    }
    /**
     *
     * @param string $productId
     * @return CartProduct|null $cartProduct
     */
    public function getCartProduct(string $productId): ?CartProduct
    {
        return $this->visitor->cartProducts()->where('product_id', $productId)->first();
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

    }

    /**
     * Get the Current Collection for the Prophetoducts.
     * @return \Illuminate\Support\Collection
     */
    public function getSession()
    {

    }

    /**
     * Get the Session Key for the Session Manager.
     * @return string $sessionKey
     */
    public function getSessionKey()
    {

    }


    /**
     * Update the Session Collection.
     * @return self $this
     */
    protected function updateSessionCollection()
    {

        return $this;
    }

    /**
     * Get the List of All the Current Session Cart Products.
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this;
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
