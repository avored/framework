<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductModelInterface
{
    use FilterTrait;

    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
        'slug',
        'type'
    ];

    /**
     * 
     * @var \AvoRed\Framework\Database\Models\Product $model
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
     * Find a Product by given id.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Product $product
     */
    public function find(int $id): Product
    {
        return Product::find($id);
    }

    /**
     * Get all the products from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $products
     */
    public function all() : Collection
    {
        return Product::all();
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
     * Delete Product Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Product::destroy($id);
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
