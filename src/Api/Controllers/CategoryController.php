<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Product\Requests\CategoryRequest;
use AvoRed\Framework\Api\Resources\Category\CategoryResource;
use AvoRed\Framework\Api\Resources\Category\CategoryCollectionResource;

class CategoryController extends Controller
{
    /**
     * Return upto 10 Record for an Resource in Json Formate
     *
     * @return \Illuminate\Http\Resources\CollectsResources
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return new CategoryCollectionResource($categories);
    }

    /**
     * Create an Resource and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        return (new CategoryResource($category));
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * Destroy an Record and Return Null Json Response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return JsonResponse::create(null, 204);
    }
}
