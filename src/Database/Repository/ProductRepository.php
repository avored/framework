<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Catalog\Requests\ProductRequest;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Traits\FilterTrait;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductModelInterface
{
    use FilterTrait;

    /**
     * Filterable Fields
     * @var array
     */
    protected $filterFields = [
        'name',
        'slug',
        'type',
    ];

    /**
     *
     * @var \AvoRed\Framework\Database\Models\Product
     */
    protected $model;

    /**
     * Construct for the Produdct Repository
     *
     */
    public function __construct()
    {
        $this->model = new Product();
    }

    /**
     * Find a Product by given slug.
     * @param string $slug
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function findBySlug(string $slug): Product
    {
        return Product::whereSlug($slug)->first();
    }

    /**
     * Find a Product by given barcode.
     * @param string $barcode
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function findByBarcode(string $barcode): Product
    {
        return Product::whereBarcode($barcode)->first();
    }

    /**
     * Get all the products from the connected database.
     * @param int $perPage
     * @return \Illuminate\Database\Eloquent\Collection $products
     */
    public function getAllWithoutVaiation(int $perPage = 10): LengthAwarePaginator
    {
        return Product::withoutVariation()->paginate($perPage);
    }

    /**
     * Sync Product with categories.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return bool
     */
    public function saveProductCategories(Product $product, ProductRequest $request): void
    {
        if ($request->get('category_id') !== null && count($request->get('category_id')) > 0) {
            $product->categories()->sync($request->get('category_id'));
        }
    }

    /**
     * Model object for the repository
     * @return \AvoRed\Framework\Database\Models\Product $model
     */
    public function model()
    {
        return $this->model;
    }
}
