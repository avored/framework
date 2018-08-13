<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Product\Requests\CategoryRequest;
use AvoRed\Framework\Api\Controllers\Controller;
use AvoRed\Framework\Api\Resources\Category\CategoryResource;
use AvoRed\Framework\Api\Resources\Category\CategoryCollectionResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);

        return new CategoryCollectionResource($categories);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        return (new CategoryResource($category));
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return JsonResponse::create(null, 204);
    }
}
