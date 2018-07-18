<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Events\ProductAfterSave;
use AvoRed\Framework\Events\ProductBeforeSave;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use AvoRed\Framework\Image\LocalFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use AvoRed\Framework\Models\Contracts\ProductDownloadableUrlInterface;
use Illuminate\Support\Facades\Session;
use AvoRed\Ecommerce\Models\Contracts\SiteCurrencyInterface;

class Product extends Model
{
    public static $VARIATION_TYPE = 'VARIATION';

    protected $fillable = ['type', 'name', 'slug', 'sku',
        'description', 'status', 'in_stock', 'track_stock', 'price',
        'qty', 'is_taxable', 'meta_title', 'meta_description',
        'weight', 'width', 'height', 'length',
    ];

    /**
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $_collection = null;

    public function getPropertiesAll()
    {
        $properties = Property::whereUseForAllProducts(1)->get();
        $collections = $this->getProductAllProperties();
        $existingIds = $collections->pluck('property_id');

        foreach ($properties as $property) {
            if (!in_array($property->id, array_values($existingIds->toArray()))) {
                $collections->push($property);
            }
        }
        return $collections;
    }

    public function hasVariation()
    {
        if ($this->type == self::$VARIATION_TYPE) {
            return true;
        }

        return false;
    }

    public static function getProductBySlug($slug)
    {
        $model = new static;

        return $model->where('slug', '=', $slug)->first();
    }

    public static function boot()
    {
        parent::boot();

        // registering a callback to be executed upon the creation of an activity AR
        static::creating(function ($model) {
            // produce a slug based on the activity title
            $slug = Str::slug($model->name);

            // check to see if any other slugs exist that are the same & count them
            $count = static::where('slug', '=', $slug)->count();

            // if other slugs exist that are the same, append the count to the slug
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function getPriceAttribute($val)
    {
        $currentCurrencyCode = Session::get('currency_code');

        if (null === $currentCurrencyCode) {
            return $val;
        }

        $siteCurrency = App::get(SiteCurrencyInterface::class);
        $model = $siteCurrency->findByCode($currentCurrencyCode);

        return $val * $model->conversion_rate;
    }

    /**
     * Update the Product and Product Related Data.
     *
     * @var array $data
     * @return void
     */
    public function saveProduct($data)
    {
        //Event::fire(new ProductBeforeSave($data));

        $this->update($data);

        $this->saveProductProperties($data);
        $this->saveProductAttributes($data);
        $this->saveProductDownloadable($data);

        //Event::fire(new ProductAfterSave($this, $data));

        return $this;
    }

    /**
     * Save Product Downloadable Information
     *
     * @param array $data
     * @return void
     */
    protected function saveProductDownloadable($data)
    {
        if (isset($data['downloadable']) && count($data['downloadable']) > 0) {
            $repository = App::get(ProductDownloadableUrlInterface::class);

            $mainDownloadableMedia = ($data['downloadable']['main_product']) ?? null;

            if (null === $mainDownloadableMedia) {
                throw new \Exception('Invalid Downloadable Media Given or Nothing Given');
            }

            $tmpPath = str_split(strtolower(str_random(3)));
            $path = 'uploads/downloadables/' . implode('/', $tmpPath);
            $dbPath = $mainDownloadableMedia->store($path, 'avored');
            $token = str_random(32);

            $downModel = $repository->query()->whereProductId($this->id)->first();

            if (null === $downModel) {
                $downModel = ProductDownloadableUrl::create([
                                        'token' => $token,
                                        'product_id' => $this->id,
                                        'main_path' => $dbPath
                                        ]);
            } else {
                $downModel->update(['main_path' => $dbPath]);
            }

            $demoDownloadableMedia = ($data['downloadable']['demo_product']) ?? null;

            if (null !== $demoDownloadableMedia) {
                $tmpPath = str_split(strtolower(str_random(3)));
                $path = 'uploads/downloadables/' . implode('/', $tmpPath);
                $demoDbPath = $demoDownloadableMedia->store($path, 'avored');

                $downModel->update(['demo_path' => $demoDbPath]);
            }
        }
    }

    /**
     * Save Product Attributes
     *
     * @param array $data
     * @return void
     */
    protected function saveProductProperties($data)
    {
        $properties = isset($data['property']) ? $data['property'] : [];

        if (count($properties) > 0) {
            foreach ($properties as $key => $property) {
                foreach ($property as $propertyId => $propertyValue) {
                    $propertyModel = Property::findorfail($propertyId);
                    $propertyModel->saveProperty($this->id, $propertyValue);
                }
            }
        }
    }

    /**
     * Save Product Attributes
     *
     * @param array $data
     * @return void
     */
    protected function saveProductAttributes($data)
    {
        $attributeWithOptions = isset($data['attribute']) ? $data['attribute'] : [];

        if (count($attributeWithOptions) > 0) {
            $selectedAttributes = isset($data['attribute_selected']) ? $data['attribute_selected'] : [];

            $this->attribute()->sync($selectedAttributes);

            $optionsArray = [];

            foreach ($attributeWithOptions as $attributeId => $attributeOptions) {
                $optionsArray[] = array_values($attributeOptions);
            }

            $listOfOptions = $this->combinations($optionsArray);

            foreach ($listOfOptions as $option) {
                $variationProductData['name'] = $this->name;
                $variationProductData['type'] = 'VARIABLE_PRODUCT';
                $variationProductData['status'] = 0;
                $variationProductData['qty'] = $this->qty;
                $variationProductData['price'] = $this->price;

                if (is_array($option)) {
                    foreach ($option as $attributeOptionId) {
                        $attributeOptionModel = AttributeDropdownOption::findorfail($attributeOptionId);
                        $variationProductData['name'] .= ' ' . $attributeOptionModel->display_text;
                    }
                } else {
                    $attributeOptionModel = AttributeDropdownOption::findorfail($option);
                    $variationProductData['name'] .= ' ' . $attributeOptionModel->display_text;
                }

                $variationProductData['sku'] = str_slug($variationProductData['name']);
                $variationProductData['slug'] = str_slug($variationProductData['name']);

                $variableProduct = self::create($variationProductData);

                if (isset($data['category_id']) && count($data['category_id']) > 0) {
                    $variableProduct->categories()->sync($data['category_id']);
                }

                ProductAttributeIntegerValue::create([
                    'product_id' => $variableProduct->id,
                    'attribute_id' => $attributeOptionModel->attribute->id,
                    'value' => $attributeOptionModel->id,
                ]);

                ProductVariation::create(['product_id' => $this->id, 'variation_id' => $variableProduct->id]);
            }
        }
    }

    public function combinations($arrays, $i = 0)
    {
        if (!isset($arrays[$i])) {
            return [];
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = $this->combinations($arrays, $i + 1);

        $result = [];

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ?
                    array_merge([$v], $t) :
                    [$v, $t];
            }
        }

        return $result;
    }

    /**
     * return default Image or LocalFile Object.
     *
     * @return \AvoRed\Framework\Image\LocalFile
     */
    public function getImageAttribute()
    {
        $defaultPath = '/img/default-product.jpg';
        $image = $this->images()->where('is_main_image', '=', 1)->first();

        if (null === $image) {
            return new LocalFile($defaultPath);
        }

        if ($image->path instanceof LocalFile) {
            return $image->path;
        }
    }

    /**
     * Get All Properties for the Product.
     *
     * @param Collection $collection
     * @return \Illuminate\Support\Collection
     */
    public function getProductAllProperties()
    {
        $collection = Collection::make([]);

        foreach ($this->productVarcharProperties as $item) {
            $collection->push($item);
        }

        foreach ($this->productBooleanProperties as $item) {
            $collection->push($item);
        }

        foreach ($this->productTextProperties as $item) {
            $collection->push($item);
        }

        foreach ($this->productDecimalProperties as $item) {
            $collection->push($item);
        }

        foreach ($this->productDecimalProperties as $item) {
            $collection->push($item);
        }

        foreach ($this->productIntegerProperties as $item) {
            $collection->push($item);
        }

        foreach ($this->productDatetimeProperties as $item) {
            $collection->push($item);
        }

        return $collection;
    }

    /**
     * Get All Attribute for the Product.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAttributeOptions()
    {
        return Attribute::all()->pluck('name', 'id');
    }

    /**
     * Get All Attribute for the Product.
     *
     * @param $variation
     * @return \Illuminate\Support\Collection
     */
    public function getProductAllAttributes($variation = null)
    {
        if (null === $variation) {
            $variations = $this->productVariations()->get();
        }

        $collection = Collection::make([]);

        if (null === $variations || $variations->count() <= 0) {
            return $collection;
        }

        foreach ($variations as $variation) {
            $variationModel = self::findorfail($variation->variation_id);

            foreach ($variationModel->productVarcharAttributes as $item) {
                $collection->push($item);
            }
            foreach ($variationModel->productBooleanAttributes as $item) {
                $collection->push($item);
            }

            foreach ($variationModel->productTextAttributes as $item) {
                $collection->push($item);
            }
            foreach ($variationModel->productDecimalAttributes as $item) {
                $collection->push($item);
            }
            foreach ($variationModel->productDecimalAttributes as $item) {
                $collection->push($item);
            }
            foreach ($variationModel->productIntegerAttributes as $item) {
                $collection->push($item);
            }

            foreach ($variationModel->productDatetimeAttributes as $item) {
                $collection->push($item);
            }
        }

        return $collection;
    }

    /**
     * Get Variable Product by Attribute Drop down Option.
     *
     * @param \AvoRed\Framework\Models\Database\AttributeDropdownOption
     * @return \AvoRed\Framework\Models\Database\ProductVariation
     */
    public function getVariableProduct($attributeDropdownOption)
    {
        $productAttributeIntegerValue = ProductAttributeIntegerValue::
                                                whereAttributeId($attributeDropdownOption->attribute_id)
                                                ->whereValue($attributeDropdownOption->id)->first();

        if (null === $productAttributeIntegerValue) {
            return;
        }

        return self::findorfail($productAttributeIntegerValue->product_id);
    }

    public function getVariableMainProduct($variationId = null)
    {
        if (null === $variationId) {
            $variationId = $this->attributes['id'];
        }

        $productVariationModel = ProductVariation::whereVariationId($variationId)->first();
        $model = new static();

        return $model->find($productVariationModel->product_id);
    }

    /**
     * Product has many Categories.
     *
     * @return \AvoRed\Framework\Models\Database\Category
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Product has many Image.
     *
     * @return \AvoRed\Framework\Models\Database\ProductImage
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Product has many Variation.
     *
     * @return \AvoRed\Framework\Models\Database\ProductVariation
     */
    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * Product has many Integer Attribute.
     *
     * @return \AvoRed\Framework\Models\Database\ProductAttributeIntegerValue
     */
    public function productIntegerAttributes()
    {
        return $this->hasMany(ProductAttributeIntegerValue::class);
    }

    /**
     * Product has many Date Time Properties.
     *
     * @return \AvoRed\Framework\Models\Database\ProductPropertyVarcharValue
     */
    public function productVarcharProperties()
    {
        return $this->hasMany(ProductPropertyVarcharValue::class);
    }

    /**
     * Product has many Date Time Properties.
     *
     * @return \AvoRed\Framework\Models\Database\ProductPropertyDatetimeValue
     */
    public function productDatetimeProperties()
    {
        return $this->hasMany(ProductPropertyDatetimeValue::class);
    }

    /**
     * Product has many Boolean Properties.
     *
     * @return \AvoRed\Framework\Models\Database\ProductPropertyBooleanValue
     */
    public function productBooleanProperties()
    {
        return $this->hasMany(ProductPropertyBooleanValue::class);
    }

    /**
     * Product has many Integer Properties.
     *
     * @return \AvoRed\Framework\Models\Database\ProductPropertyIntegerValue
     */
    public function productIntegerProperties()
    {
        return $this->hasMany(ProductPropertyIntegerValue::class);
    }

    /**
     * Product has many Text Properties.
     *
     * @return \AvoRed\Framework\Models\Database\ProductPropertyTextValue
     */
    public function productTextProperties()
    {
        return $this->hasMany(ProductPropertyTextValue::class);
    }

    /**
     * Product has many Decimal Properties.
     *
     * @return \AvoRed\Framework\Models\Database\ProductPropertyDecimalValue
     */
    public function productDecimalProperties()
    {
        return $this->hasMany(ProductPropertyDecimalValue::class);
    }

    /**
     * Product has many Attribute.
     *
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function attribute()
    {
        return $this->belongsToMany(Attribute::class);
    }

    /**
     * Product has many Order.
     *
     * @return \AvoRed\Framework\Models\Database\Order
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Product has downladable Url.
     *
     * @return \AvoRed\Framework\Models\Database\ProductDownloadableUrl
     */
    public function downloadable()
    {
        return $this->hasOne(ProductDownloadableUrl::class);
    }

    /*
    public function getCollection()
    {
        $model = new static;
        $products = $model->all();
        //$productCollection = new ProductCollection();
        //$productCollection->setCollection($products);

        $this->setCollection($products);

        return $this;
    }
    public function setCollection($products)
    {
        $this->_collection = $products;

        return $this;
    }

       public function addAttributeFilter($attributeId, $value)
    {
        $this->_collection = $this->_collection->filter(function ($product) use ($attributeId, $value) {
            foreach ($this->getProductAllAttributes() as $productAttribute) {
                if ($productAttribute->attribute_id == $attributeId && $productAttribute->value == $value) {
                    return $product;
                }
            }
        });

        return $this->_collection;
    }

    public function addPropertyFilter($attributeId, $value)
    {
        $this->_collection = $this->_collection->filter(function ($product) use ($attributeId, $value) {
            foreach ($product->getProductAllProperties() as $productAttribute) {
                if ($productAttribute->property_id == $attributeId && $productAttribute->value == $value) {
                    return $product;
                }
            }
        });

        return $this->_collection;
    }

    public function productPaginate($products, $perPage = 10)
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

    public function addCategoryFilter($categoryId)
    {
        $this->_collection = $this->_collection->filter(function ($product) use ($categoryId) {
            if ($product->categories->count() > 0 && $product->categories->pluck('id')->contains($categoryId)) {
                return $product;
            }
        });

        return $this;
    } */
}
