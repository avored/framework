<?php

namespace AvoRed\Framework\Observers;

use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Database\ProductImage;
use AvoRed\Framework\Models\Database\CategoryFilter;

class ProductObserver
{
    /**
     * Product Model Object
     * @var \AvoRed\Framework\Models\Database\Product
     */
    public $product;

    /**
    * Handle to the Product "created" event.
    *
    * @param  \AvoRed\Framework\Models\Database\Product  $product
    * @return void
    */
    public function created(Product $product)
    {
    }

    /**
    * Handle to the Product "updated" event.
    *
    * @param  \AvoRed\Framework\Models\Database\Product  $product
    * @return void
    */
    public function updated(Product $product)
    {
        $this->product = $product;
        $this->saveProductImages();
        $this->saveCategoryFilters();
        $this->saveProductCategories();
    }

    /**
    * Save Product Images.
    *
    * @param array $$data
    * @return void
    */
    public function saveProductImages()
    {
        $request = request();

        $images = $request->get('image');
        if (count($images) > 0) {
            $exitingIds = $this->product->images->pluck('id')->toArray();
            foreach ($images as $key => $data) {
                if (is_int($key)) {
                    if (($findKey = array_search($key, $exitingIds)) !== false) {
                        $productImage = ProductImage::findorfail($key);
                        $productImage->update($data);
                        unset($exitingIds[$findKey]);
                    }
                    continue;
                }
                ProductImage::create($data + ['product_id' => $this->product->id]);
            }
            if (count($exitingIds) > 0) {
                ProductImage::destroy($exitingIds);
            }
        }
    }

    /**
     * Save Category Filter -- Property and Attributes Ids
     *
     *
     * @param array $data
     * @return void
     */
    public function saveCategoryFilters()
    {
        $data = request()->toArray();

        $categoryIds = $data['category_id'] ?? [];

        foreach ($categoryIds as $categoryId) {
            $propertyIds = $data['product-property'] ?? [];

            foreach ($propertyIds as $propertyId) {
                $filterModel = CategoryFilter::whereCategoryId($categoryId)
                                                ->whereFilterId($propertyId)
                                                ->whereType('PROPERTY')->first();
                if (null === $filterModel) {
                    CategoryFilter::create([
                        'category_id' => $categoryId,
                        'filter_id' => $propertyId,
                        'type' => 'PROPERTY'
                    ]);
                }
            }

            $attrbuteIds = isset($data['attribute_selected']) ? $data['attribute_selected'] : [];

            foreach ($attrbuteIds as $attrbuteId) {
                $filterModel = CategoryFilter::whereCategoryId($categoryId)
                                                ->whereFilterId($attrbuteId)
                                                ->whereType('ATTRIBUTE')->first();
                if (null === $filterModel) {
                    CategoryFilter::create([
                        'category_id' => $categoryId,
                        'filter_id' => $attrbuteId,
                        'type' => 'ATTRIBUTE'
                    ]);
                }
            }
        }
    }

    /**
     * Save Product Categories
     *
     * @param array $data
     * @return void
     */
    protected function saveProductCategories()
    {
        $data = request()->toArray();

        if (isset($data['category_id']) && count($data['category_id']) > 0) {
            $this->product->categories()->sync($data['category_id']);
        }
    }
}
