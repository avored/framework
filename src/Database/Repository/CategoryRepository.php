<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Models\Property;

class CategoryRepository implements CategoryModelInterface
{
    /**
     * Create Category Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Find Category Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function find(int $id): Category
    {
        return Category::find($id);
    }

    /**
     * Find Category Resource into a database
     * @param string $slug
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function findBySlug(string $slug): Category
    {
        return Category::whereSlug($slug)->first();
    }

    /**
     * Get All Category from the database
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function getCategoryProducts(Request $request) : Collection
    {
        $builder = Product::whereHas('categories', function ($query) use ($request) {
            $query->whereSlug($request->get('slug'));
        });

        foreach ($request->except(['slug', '_token']) as $key => $values) {
            list ($filterType , $paramSuffix) = $this->splitParam($key);
           
            if ($filterType === 'PROPERTY') {
                $builder = $this->filterProperties($builder, $paramSuffix, $values);
            }
        }
        
        return $builder->get();
    }
    /**
     * Delete Category Resource from a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function delete(int $id): bool
    {
        return Category::destroy($id);
    }

    /**
     * Get all the categories from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection
    {
        return Category::all();
    }

    /**
     * Get all the categories options to use in dropdown
     * @return \Illuminate\Database\Eloquent\Collection $categoryOptions
     */
    public function options() : SupportCollection
    {
        return Category::all()->pluck('name', 'id');
    }

    /**
     * filter properties via builder
     * @return \Illuminate\Database\Eloquent\Builder $builder
     */
    private function filterProperties($builder, $paramSuffix, $values)
    {
        $property = Property::whereSlug($paramSuffix)->first();
        
        $builder->whereHas('productPropertyIntegerValues', function ($query) use ($property, $values) {
            $query
                ->wherePropertyId($property->id)
                ->whereIn('value', $values);
        });
        
        return $builder;
    }

    /**
     * Split the param and find out which type and etc
     * @return array
     */
    private function splitParam($key)
    {
        $filterType = '';
        $paramPrefix = substr($key, 0, 4);
        $paramSuffix = substr($key, 4);
        
        if ($paramPrefix === 'p___') {
            $filterType = 'PROPERTY';
        } elseif ($paramPrefix === 'a___') {
            $filterType = 'ATTRIBUTE';
        }
        return [$filterType, $paramSuffix];
    }
}
