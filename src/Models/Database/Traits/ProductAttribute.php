<?php
/**
 * Created by PhpStorm.
 * User: ludio
 * Date: 23/01/19
 * Time: 15:59
 */

namespace AvoRed\Framework\Models\Database\Traits;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use AvoRed\Framework\Image\LocalFile;
use AvoRed\Framework\Models\Contracts\SiteCurrencyInterface;
use AvoRed\Framework\Models\Database\ProductImage;
use AvoRed\Framework\Events\ProductBeforeSave;
use AvoRed\Framework\Events\ProductAfterSave;
use AvoRed\Framework\Models\Contracts\ProductDownloadableUrlInterface;
use AvoRed\Framework\Models\Database\ProductDownloadableUrl;
use AvoRed\Framework\Models\Database\AttributeDropdownOption;
use AvoRed\Framework\Models\Database\ProductVariation;
use AvoRed\Framework\Models\Contracts\CategoryFilterInterface;
use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Models\Database\ProductAttributeIntegerValue;


trait ProductAttribute
{
    public function needsShipping()
    {
        return ($this->type !== 'DOWNLOADABLE');
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

        return number_format($val * $model->conversion_rate, 2);
    }

    /**
     * Save Product Images.
     *
     * @param array $$data
     * @return \AvoRed\Framework\Models\Database\Product $this
     */
    public function saveProductImages(array $data): self
    {
        if (isset($data['image']) && count($data['image']) > 0) {
            $exitingIds = $this->images()->get()->pluck('id')->toArray();

            foreach ($data['image'] as $key => $dataImage) {
                if (is_int($key)) {
                    if (($findKey = array_search($key, $exitingIds)) !== false) {
                        $productImage = ProductImage::findorfail($key);
                        $productImage->update($dataImage);
                        unset($exitingIds[$findKey]);
                    }
                    continue;
                }
                ProductImage::create($dataImage + ['product_id' => $this->id]);
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

        if (isset($variations) && null === $variations || $variations->count() <= 0) {
            return $collection;
        }

        foreach ($variations as $variation) {
            $variationModel = self::findOrFail($variation->variation_id);

            foreach ($variationModel->productIntegerAttributes()->select(['id', 'product_id', 'value', 'attribute_id'])->get() as $item) {
                $collection->push($item);
            }
//
//            foreach ($variationModel->productVarcharAttributes as $item) {
//                $collection->push($item);
//            }
//            foreach ($variationModel->productBooleanAttributes as $item) {
//                $collection->push($item);
//            }
//
//            foreach ($variationModel->productTextAttributes as $item) {
//                $collection->push($item);
//            }
//            foreach ($variationModel->productDecimalAttributes as $item) {
//                $collection->push($item);
//            }
//            foreach ($variationModel->productDecimalAttributes as $item) {
//                $collection->push($item);
//            }
//            foreach ($variationModel->productDatetimeAttributes as $item) {
//                $collection->push($item);
//            }
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

    /**
     * @param null $variationId
     * @return mixed
     */
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
     * @return mixed
     */
    public function getVariationsWithAttributes()
    {
        $variations = $this->productVariations()->with('variationProduct')->get();
        $data = [];
        foreach ($variations as $variationModel)
        {
            $item = array(
                'parent_id' => $variationModel->product_id,
                'id' => $variationModel->variation_id,
                'name' => $variationModel->variationProduct->name,
                'sku' => $variationModel->variationProduct->sku,
                'qty' => $variationModel->variationProduct->qty,
                'weight' => $variationModel->variationProduct->weight,
                'width' => $variationModel->variationProduct->width,
                'price' => $variationModel->variationProduct->price,
                'regular_price' => $variationModel->variationProduct->regular_price,
                'height' => $variationModel->variationProduct->height,
                'length' => $variationModel->variationProduct->length,
                'created_at' => $variationModel->variationProduct->created_at,
                'updated_at' => $variationModel->variationProduct->updated_at,
                'attributes' => $variationModel->variationProduct->productIntegerAttributes()->where('product_id', '=', $variationModel->variation_id)
                    ->select(['id', 'product_id', 'value', 'attribute_id'])->get()->toArray()
            );
            $data[$variationModel->variation_id] = $item;
        }

        return collect($data);
    }



    /**
     * Get the Product Variation Product Json Data
     * @return array $jsonData
     */
    public function getProductVariationJsonData()
    {
        $lists = ProductAttributeIntegerValue::whereIn(
            'product_id',
            $this->productVariations->pluck('variation_id')
        )->get();

        $jsonData = array();

        foreach ($lists as $list) {
            $variationModel = Product::find($list->product_id);
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


    public function getPercentageDiscountAttribute()
    {
        $regularPrice = $this->regular_price;
        $salePrice = $this->price;
        if ($regularPrice && $salePrice) {
            return (($regularPrice - $salePrice)*100) / $regularPrice;
        }
        return 0;
    }




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
        return ($this->type == self::$VARIATION_TYPE);
    }
}
