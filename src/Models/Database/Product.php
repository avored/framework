<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Events\ProductAfterSave;
use AvoRed\Framework\Events\ProductBeforeSave;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use AvoRed\Framework\Image\LocalFile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use AvoRed\Framework\Models\Contracts\ProductDownloadableUrlInterface;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\SiteCurrencyInterface;
use AvoRed\Framework\Models\Contracts\CategoryFilterInterface;

class Product extends BaseModel
{
    const VARIATION_TYPE = 'VARIATION';

    protected $fillable = ['type', 'name', 'slug', 'sku',
        'description', 'status', 'in_stock', 'track_stock', 'price', 'cost_price',
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

    /**
     * Get the Product Variation Product Json Data
     * @return array $jsonData
     */
    public function getProductVariationJsonData()
    {
        $jsonData = [];
        $lists = ProductAttributeIntegerValue::whereIn(
            'product_id',
            $this->productVariations->pluck('variation_id')
        )->get();
        
        foreach ($lists as $list) {
            $variationModel = self::find($list->product_id);
            if (array_has($jsonData, $list->product_id)) {
                $data = array_get($jsonData, $list->product_id);
                $data[$list->attribute_id] = [
                    $list->value => ['qty' => $variationModel->qty, 'price' => $variationModel->price]
                ];
                $jsonData[$list->product_id] = $data;
            } else {
                $jsonData[$list->product_id] = [$list->attribute_id => [
                    $list->value => ['qty' => $variationModel->qty, 'price' => $variationModel->price]]
                ];
            }
        }
        return $jsonData;
    }

    public function hasVariation()
    {
        if ($this->type == self::VARIATION_TYPE) {
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

    /**
     * Get the Price for the Product
     *
     * @param float $val
     * @return float $price
     */
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
     * Save Product Images.
     *
     * @param array $$data
     * @return \AvoRed\Framework\Models\Database\Product $this
     */
    public function saveProductImages(array $data):self
    {
        if (isset($data['image']) && count($data['image']) > 0) {
            $exitingIds = $this->images()->get()->pluck('id')->toArray();
            foreach ($data['image'] as $key => $data) {
                if (is_int($key)) {
                    if (($findKey = array_search($key, $exitingIds)) !== false) {
                        $productImage = ProductImage::findorfail($key);
                        $productImage->update($data);
                        unset($exitingIds[$findKey]);
                    }
                    continue;
                }
                ProductImage::create($data + ['product_id' => $this->id]);
            }
            if (count($exitingIds) > 0) {
                ProductImage::destroy($exitingIds);
            }
        }
        return $this;
    }

    /**
     * Update the Product and Product Related Data.
     *
     * @var array $data
     * @return void
     */
    public function saveProduct($data)
    {
        Event::fire(new ProductBeforeSave($data));

        $this->update($data);
        $this->saveProductImages($data);
        $this->saveCategoryFilters($data);
        $this->saveProductCategories($data);
        $this->saveProductProperties($data);
        $this->saveProductAttributes($data);
        $this->saveProductDownloadable($data);

        Event::fire(new ProductAfterSave($this, $data));

        return $this;
    }

    /**
     * Save Product Categories
     *
     * @param array $data
     * @return void
     */
    protected function saveProductCategories($data)
    {
        if (isset($data['category_id']) && count($data['category_id']) > 0) {
            $this->categories()->sync($data['category_id']);
        }
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
                    $propertyModel->attachProduct($this)
                                    ->fill(['value' => $propertyValue])
                                    ->save();
                    $syncProperty[] = $propertyId;
                }
                $this->properties()->sync($syncProperty);
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
                $variationProductData = $this->getVariationProductDataGivenOptions($option);
                $variableProduct = self::create($variationProductData);

                if (isset($data['category_id']) && count($data['category_id']) > 0) {
                    $variableProduct->categories()->sync($data['category_id']);
                }

                if (is_array($option)) {
                    foreach ($option as $attributeOptionId) {
                        $attributeOptionModel = AttributeDropdownOption::findorfail($attributeOptionId);
                        ProductAttributeIntegerValue::create([
                            'product_id' => $variableProduct->id,
                            'attribute_id' => $attributeOptionModel->attribute->id,
                            'value' => $attributeOptionModel->id,
                        ]);
                    }
                } else {
                    $attributeOptionModel = AttributeDropdownOption::findorfail($option);
                    ProductAttributeIntegerValue::create([
                        'product_id' => $variableProduct->id,
                        'attribute_id' => $attributeOptionModel->attribute->id,
                        'value' => $attributeOptionModel->id,
                    ]);
                }

                ProductVariation::create(['product_id' => $this->id,
                    'variation_id' => $variableProduct->id
                ]);
            }
        }
    }

    /**
     * Make all combination based on attributes array
     *
     * @param array $options
     * @return void
     */
    public function getVariationProductDataGivenOptions($options)
    {
        $data['name'] = $this->name;

        if (is_array($options)) {
            foreach ($options as $attributeOptionId) {
                $attributeOptionModel = AttributeDropdownOption::findorfail($attributeOptionId);
                $data['name'] .= ' ' . $attributeOptionModel->display_text;
            }
        } else {
            $attributeOptionModel = AttributeDropdownOption::findorfail($options);
            $data['name'] .= ' ' . $attributeOptionModel->display_text;
        }

        $data['sku'] = str_slug($data['name']);
        $data['slug'] = str_slug($data['name']);

        $data['type'] = 'VARIABLE_PRODUCT';
        $data['status'] = 0;
        $data['qty'] = $this->qty;
        $data['price'] = $this->price;

        return $data;
    }

    /**
     * Make all combination based on attributes array
     *
     * @param array $arrays
     * @param integer $i
     * @return array $result
     */
    public function combinations($arrays, $i = 0)
    {
        if (!isset($arrays[$i])) {
            return [];
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        $tmp = $this->combinations($arrays, $i + 1);

        $result = [];

        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ?
                    array_merge([$v], $t) : [$v, $t];
            }
        }

        return $result;
    }

    /**
     * Save Category Filter -- Property and Attributes Ids
     *
     *
     * @param array $data
     * @return void
     */
    public function saveCategoryFilters($data)
    {
        $categoryIds = array_get($data, 'category_id', []);

        foreach ($categoryIds as $categoryId) {
            $rep = app(CategoryFilterInterface::class);

            $propertyIds = array_get($data, 'product_property', []);

            foreach ($propertyIds as $propertyId) {
                $rep->saveFilter($categoryId, $propertyId, $type = 'PROPERTY');
            }

            $attributeIds = array_get($data, 'attribute_selected', []);
            foreach ($attributeIds as $attrbuteId) {
                $rep->saveFilter($categoryId, $attrbuteId, $type = 'ATTRIBUTE');
            }
        }
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Product has many Categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    /**
     * Product has many Image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Product has many Variation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * Product has many Integer Attribute.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productIntegerAttributes()
    {
        return $this->hasMany(ProductAttributeIntegerValue::class);
    }

    /**
     * Product has many Date Time Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productVarcharProperties()
    {
        return $this->hasMany(ProductPropertyVarcharValue::class);
    }

    /**
     * Product has many Date Time Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDatetimeProperties()
    {
        return $this->hasMany(ProductPropertyDatetimeValue::class);
    }

    /**
     * Product has many Boolean Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productBooleanProperties()
    {
        return $this->hasMany(ProductPropertyBooleanValue::class);
    }

    /**
     * Product has many Integer Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productIntegerProperties()
    {
        return $this->hasMany(ProductPropertyIntegerValue::class);
    }

    /**
     * Product has many Text Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productTextProperties()
    {
        return $this->hasMany(ProductPropertyTextValue::class);
    }

    /**
     * Product has many Decimal Properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDecimalProperties()
    {
        return $this->hasMany(ProductPropertyDecimalValue::class);
    }

    /**
     * Product has many Attribute.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attribute()
    {
        return $this->belongsToMany(Attribute::class);
    }

    /**
     * Product has many Order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Product has downladable Url.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function downloadable()
    {
        return $this->hasOne(ProductDownloadableUrl::class);
    }
}
