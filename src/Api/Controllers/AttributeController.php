<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Attribute;
use AvoRed\Framework\Api\Controllers\Controller;
use AvoRed\Framework\Api\Resources\Attribute\AttributeResource;
use AvoRed\Framework\Api\Resources\Attribute\AttributeCollectionResource;
use AvoRed\Framework\Product\Requests\AttributeRequest;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::paginate(10);

        return new AttributeCollectionResource($attributes);
    }

    public function store(AttributeRequest $request)
    {
        $attribute = Attribute::create($request->all());

        return (new AttributeResource($attribute));
    }

    public function show(Attribute $attribute)
    {
        return new AttributeResource($attribute);
    }

    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->all());
        return new AttributeResource($attribute);
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return JsonResponse::create(null, 204);
    }
}
