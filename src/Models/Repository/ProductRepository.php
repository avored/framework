<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Contracts\ProductInterface;

use AvoRed\Framework\Image\Facades\Image;

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
     *
     */
    public function uploadImage($request)
    {
        try {
            $image = $request->image;
            $tmpPath = str_split(strtolower(str_random(3)));
            $checkDirectory = 'uploads/catalog/images/' . implode('/', $tmpPath);

            $dbPath = $checkDirectory . '/' . $image->getClientOriginalName();
            $image = Image::upload($request->file('image'), $checkDirectory)->makeSizes()->get();

            return $image;
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

}
