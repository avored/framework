<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Contracts\ProductInterface;

use AvoRed\Framework\Image\Facades\Image;
use AvoRed\Framework\Models\Database\ProductAttributeIntegerValue;

class ProductRepository implements ProductInterface
{
    /**
     * Find a Product by a given id of a product
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\Product
     */
    public function find($id)
    {
        return Product::find($id);
    }

    /**
     * Find a Product by a given id of a product
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\Product
     */
    public function findBySlug($slug)
    {
        return Product::whereSlug($slug)->first();
    }

    /**
     * Find all product except the Variable Product to display
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function query()
    {
        return Product::query();
    }

    /**
     * return random string only lower and without digits.
     *
     * @param int $length
     * @return string $randomString
     */
    public function _getTmpString($length = 6)
    {
        $pool = 'abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }


    /**
     * Send image for a product.
     * @param $request
     * @return bool
     */
    public function uploadImage($request, $imageUpload = null)
    {
        try {
            if (null === $imageUpload)
                $imageUpload = $request->image;
            $tmpPath = str_split(strtolower(str_random(3)));
            $checkDirectory = 'uploads/catalog/images/' . implode('/', $tmpPath);

            $dbPath = $checkDirectory . '/' . $imageUpload->getClientOriginalName();
            $image = Image::upload($imageUpload, $checkDirectory)->makeSizes()->get();

            return $image;
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    public function getProductVariationWithCombinations($parentId, $attributes = [])
    {
        // Get variations with attributes
        $variations = $this->query()
            ->with('productVariations')
            ->find($parentId);

        $variations = $variations->productVariations->pluck('variation_id');

        $collections = array();
        foreach ($attributes as $key => $value)
        {
            $collections[] = ProductAttributeIntegerValue::whereIn('product_id', $variations)
                ->where(['attribute_id' => $key, 'value' => $value])->pluck('product_id')->toArray();
        }

        $intersecao = array_intersect(...$collections);
        if (count($intersecao) > 0) {
            return $this->query()->select(['id', 'price', 'name', 'width', 'height', 'length', 'weight', 'slug', 'qty'])->find(reset($intersecao));
        }

        return false;
    }

}
