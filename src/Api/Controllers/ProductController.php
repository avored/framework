<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Product\Requests\ProductRequest;
use AvoRed\Framework\Api\Controllers\Controller;
use AvoRed\Framework\Api\Resources\Product\ProductResource;
use AvoRed\Framework\Api\Resources\Product\ProductCollectionResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return new ProductCollectionResource($products);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());

        return (new ProductResource($product));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return JsonResponse::create(null, 204);
    }
}
