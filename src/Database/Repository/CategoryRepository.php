<?php

namespace AvoRed\Framework\Database\Repository;

use stdClass;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Database\Models\Attribute;
use Illuminate\Support\Collection as SupportCollection;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class CategoryRepository extends BaseRepository implements CategoryModelInterface
{
    use FilterTrait;
   
    /**
     * Eloquent Model Instant for the Repository
     * @var \AvoRed\Framework\Database\Models\Category $model
     */
    protected $model;

    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
        'slug',
        'meta_title',
        'meta_description'
    ];


    /**
     * Construct for the Category Repository
     * 
     */
    public function __construct()
    {
        $this->model = new Category;   
    }

    /**
     * Find Category Resource into a database.
     * @param string $slug
     * @return \AvoRed\Framework\Database\Models\Category $category
     */
    public function findBySlug(string $slug): Category
    {
        return Category::whereSlug($slug)->first();
    }

    /**
     * Get All Category from the database.
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function getCategoryProducts(Request $request) : Collection
    {
        $builder = Product::whereHas('categories', function ($query) use ($request) {
            $query->whereSlug($request->get('slug'));
        });

        foreach ($request->except(['slug', '_token']) as $key => $values) {
            [$filterType, $paramSuffix] = $this->splitParam($key);

            if ($filterType === 'PROPERTY') {
                $builder = $this->filterProperties($builder, $paramSuffix, $values);
            }

            if ($filterType === 'ATTRIBUTE') {
                $builder = $this->filterAttributes($builder, $paramSuffix, $values);
            }
        }

        $builder->where('type', '!=', 'VARIATION');

        return $builder->get();
    }

  

    /**
     * Get all the categories option to use in Menu Builder.
     * @return \Illuminate\Support\Collection $categories
     */
    public function getCategoryOptionForMenuBuilder() : SupportCollection
    {
        $categories = SupportCollection::make([]);
        $all = Category::all();

        $i = 1;
        foreach ($all as $category) {
            $dummyModel = new stdClass;
            $dummyModel->id = $i;

            $routeParam = config('avored.routes.category.param');
            $routeName = config('avored.routes.category.name');
            $dummyModel->name = $category->name;
            $dummyModel->url = route($routeName, $category->$routeParam, false);
            $dummyModel->submenus = [];

            $categories->push($dummyModel);
            $i++;
        }

        return $categories;
    }

    /**
     * Get all the categories options to use in dropdown.
     * @param string $label
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Collectionp $categoryOptions
     */
    public function options($label = 'name', $value = 'id') : SupportCollection
    {
        return Category::all()->pluck($label, $value);
    }

    /**
     * filter properties via builder.
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
     * filter attributes via builder.
     * @return \Illuminate\Database\Eloquent\Builder $builder
     */
    private function filterAttributes($builder, $paramSuffix, $values)
    {
        $attribute = Attribute::whereSlug($paramSuffix)->first();
        $builder->whereHas('attributeProductValues', function ($query) use ($attribute, $values) {
            $query
                ->whereAttributeId($attribute->id)
                ->whereIn('attribute_dropdown_option_id', $values);
        });

        return $builder;
    }

    /**
     * Split the param and find out which type and etc.
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

    /**
     * Model object for the repository
     * @return \AvoRed\Framework\Database\Models\Category $model
     */
    public function model(): Category
    {
        return $this->model;
    }
}
