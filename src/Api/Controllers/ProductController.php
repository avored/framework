<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Product\Requests\ProductRequest;
use AvoRed\Framework\Api\Resources\Product\ProductResource;
use AvoRed\Framework\Api\Resources\Product\ProductCollectionResource;

class ProductController extends Controller
{
    /**
     * Return upto 10 Record for an Resource in Json Formate
     *
     * @return \Illuminate\Http\Resources\CollectsResources
     */
    public function index()
    {
        $products = Product::paginate(10);

        return new ProductCollectionResource($products);
    }

    /**
     * Create an Resource and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());

        return (new ProductResource($product));
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        $product = Product::find($id);
        return new ProductResource($product);
    }

    /**
     * Update and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return new ProductResource($product);
    }

    /**
     * Destroy an Record and Return Null Json Response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return JsonResponse::create(null, 204);
    }
}
