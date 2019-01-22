<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\CategoryInterface;
use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Database\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryInterface
{
    /**
     * Find an Category by given Id
     *
     * @param $id
     *
     * @return \AvoRed\Framework\Models\Database\Category
     */
    public function find($id)
    {
        return Category::find($id);
    }

    /**
     * Find an Category by given key which returns Category Model
     *
     * @param string $key
     *
     * @return \AvoRed\Framework\Models\Database\Category
     */
    public function findByKey($key)
    {
        return Category::whereSlug($key)->first();
    }

    /**
     * Find an Category by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Category::all();
    }

    /**
     * Paginate Category
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Category::paginate($noOfItem);
    }

    /**
     * Find an Category Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Category::query();
    }

    /**
     * Find an Category Query
     *
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function create($data)
    {
        return Category::create($data);
    }

    /*
    * Return Products of Category with Filters
    *
    *
    * @param integer $categoryId
    * @param array   $filters
    * @return \Illuminate\Support\Collection $collect
    */
    public function getCategoryProductWithFilter($categoryId, $filters = [])
    {

        $category = Category::find($categoryId);

        // Products
        $productIds = $category->products->pluck('id');
        $products = Product::whereIn('id', $category->products->pluck('id'));

        // Filters
        $methodFilters = [];

        // Filters
        foreach ($filters as $type => $filterArray) {
            if ($type == 'property') {
                foreach ($filterArray as $identifier => $value) {
                    $property = Property::whereIdentifier($identifier)->first();
                    if ($property) {
                        $relationshipMethod = $property->getProductRelationship();
                        $methodFilters[$relationshipMethod][] = [$property->id => $value];
                    }
                }
            }
        }

        // Filters
        foreach ($methodFilters as $method => $values) {
            $callback = function ($q) use ($values) {
                $wheres = [];
                foreach ($values as $value) {
                    $propertyId = key($value);
                    $value = $value[$propertyId];
                    $wheres[] = "(property_id = {$propertyId} and value = '{$value}')";
                }
                if (count($wheres)) {
                    $q->whereRaw(implode(" OR ", $wheres));
                }
            };
            $products = $products->whereHas($method, $callback)
                ->with([$method => $callback]);
        }


        if (isset($filters['orderby'])) {
            $order = $filters['orderby'];
            if (in_array($order, ['name', 'price', 'price-desc'])) {
                switch ($order) {
                    case 'name':
                        $products->orderBy('name', 'ASC');
                        break;
                    case 'price':
                        $products->orderBy('price', 'ASC');
                        break;
                    case 'price-desc':
                        $products->orderBy('price', 'DESC');
                        break;
                    default:
                        $products->latest();
                        break;
                }
            }
        }


        // TODO: ADD VARIATION ON SEARCH

        return $products->get();
    }

    /*
    * Paginate Category Page Product
    *
    *
    * @param \Illuminate\Support\Collection $products
    * @param integer $perPage
    * @return \Illuminate\Pagination\LengthAwarePaginator
    */

    public function paginateProducts($products, $perPage = 10)
    {
        $request = request();
        $page = request('page');
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            $products->slice($offset, $perPage), // Only grab the items we need
            $products->count(), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url
        );
    }

    /**
     * Get an Category Options for Vue Components
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function options($empty = true)
    {
        if (true === $empty) {
            $empty = new Category();
            $empty->name = 'Please Select';
            return Category::all()->prepend($empty);
        }
        return Category::all();
    }
}
