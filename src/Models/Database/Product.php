<?php

namespace AvoRed\Framework\Models\Database;

use Illuminate\Support\Str;
use AvoRed\Framework\Image\LocalFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Ecommerce\Models\Database\Configuration;

class Product extends Model
{
    protected $fillable = ['type', 'name', 'slug', 'sku',
        'description', 'status', 'in_stock', 'track_stock',
        'qty', 'is_taxable', 'meta_title', 'meta_description',
        'weight', 'width', 'height', 'length',
    ];

    public function getCollection()
    {
        $model = new static;
        $products = $model->all();
        $productCollection = new ProductCollection();
        $productCollection->setCollection($products);

        return $productCollection;
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

    public function hasVariation()
    {
        if ($this->type == 'VARIATION') {
            return true;
        }

        return false;
    }

    public function canAddtoCart($qty = 0)
    {
        $products = Session::get('cart');

        if (null == $products) {
            return true;
        }

        $productId = $this->attributes['id'];

        $cartProduct = $products->get($productId);

        $availableQty = $this->attributes['qty'];

        $currentCartQty = (isset($cartProduct['qty'])) ? $cartProduct['qty'] : 0;

        if ($availableQty - $currentCartQty - $qty < 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Save Product Price.
     *
     * @param float $price
     * @return \AvoRed\Framework\Models\Database\Product $this
     */
    public function saveProductPrice($price):self
    {
        if ($this->prices()->get()->count() > 0) {
            $this->prices()->get()->first()->update(['price' => $price]);
        } else {
            $this->prices()->create(['price' => $price]);
        }

        return $this;
    }

    /**
     * Save Product Images.
     *
     * @param array $images
     * @return \AvoRed\Framework\Models\Database\Product $this
     */
    public function saveProductImages(array $images):self
    {
        $exitingIds = $this->images()->get()->pluck('id')->toArray();
        foreach ($images as $key => $data) {
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

        return $this;
    }

    /**
     * Update the Product and Product Related Data.
     *
     * @var \AvoRed\Ecommerce\Http\Requests\ProductRequest
     * @return void
     */
    public function saveProduct($request)
    {
        $this->update($request->all());

        $this->saveProductPrice($request->get('price'));

        if (null !== $request->get('image')) {
            $this->saveProductImages($request->get('image'));
        }

        if (count($request->get('category_id')) > 0) {
            $this->categories()->sync($request->get('category_id'));
        }

        $properties = $request->get('property');

        if (null !== $properties && count($properties) > 0) {
            foreach ($properties as $key => $property) {
                foreach ($property as $propertyId => $propertyValue) {
                    $propertyModal = Property::findorfail($propertyId);
                    $propertyModal->saveProperty($this->id, $propertyValue);
                }
            }
        }

        $attributeWithOptions = $request->get('attribute');

        if (null !== $attributeWithOptions && count($attributeWithOptions) > 0) {
            $selectedAttributes = $request->get('attribute_selected');
            foreach ($selectedAttributes as $selectedAttribute) {
                $this->attribute()->sync($selectedAttribute);
            }

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

                if (is_array($option)) {
                    foreach ($option as $attributeOptionId) {
                        $attributeOptionModel = AttributeDropdownOption::findorfail($attributeOptionId);
                        $variationProductData['name'] .= ' '.$attributeOptionModel->display_text;
                    }
                } else {
                    $attributeOptionModel = AttributeDropdownOption::findorfail($option);
                    $variationProductData['name'] .= ' '.$attributeOptionModel->display_text;
                }

                $variationProductData['sku'] = str_slug($variationProductData['name']);
                $variationProductData['slug'] = str_slug($variationProductData['name']);

                $variableProduct = self::create($variationProductData);
                $variableProduct->prices()->create(['price' => $this->price]);

                ProductAttributeIntegerValue::create([
                    'product_id' => $variableProduct->id,
                    'attribute_id' => $attributeOptionModel->attribute->id,
                    'value' => $attributeOptionModel->id,
                ]);

                ProductVariation::create(['product_id' => $this->id, 'variation_id' => $variableProduct->id]);
            }
        }

        return $this;
    }

    public function combinations($arrays, $i = 0)
    {
        if (! isset($arrays[$i])) {
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

    public static function getProductBySlug($slug)
    {
        $model = new static;

        return $model->where('slug', '=', $slug)->first();
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

    /*
     * Get the Price for the Product
     *
     * @return float $value
     */
    public function getPriceAttribute()
    {
        $row = $this->prices()->first();

        return (isset($row->price)) ? $row->price : null;
    }

    /**
     * Get All Properties for the Product.
     *
     * @param $variation
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
     * Product has many Price.
     *
     * @return \AvoRed\Framework\Models\Database\ProductPrice
     */
    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
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
        return $this->hasMany(Attribute::class);
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
}
