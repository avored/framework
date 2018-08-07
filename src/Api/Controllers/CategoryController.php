<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Product\Requests\CategoryRequest;
use AvoRed\Framework\Api\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();

        return JsonResponse::create(['data' => $data, 'status' => true]);
    }

    public function store(CategoryRequest $request)
    {
        $data = Category::create($request->all());

        return JsonResponse::create(['data' => $data, 'status' => true], 201);
    }

    public function show($id)
    {
        $data = Category::find($id);

        return JsonResponse::create(['data' => $data, 'status' => true]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = Category::find($id);
        $data->update($request->all());

        return JsonResponse::create(['data' => $data, 'status' => true]);
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return JsonResponse::create(null, 204);
    }
}
