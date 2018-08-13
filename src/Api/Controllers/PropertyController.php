<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Api\Controllers\Controller;
use AvoRed\Framework\Api\Resources\Property\PropertyResource;
use AvoRed\Framework\Api\Resources\Property\PropertyCollectionResource;
use AvoRed\Framework\Product\Requests\PropertyRequest;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::paginate(10);

        return new PropertyCollectionResource($properties);
    }

    public function store(PropertyRequest $request)
    {
        $property = Property::create($request->all());

        return (new PropertyResource($property));
    }

    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->all());
        return new PropertyResource($property);
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return JsonResponse::create(null, 204);
    }
}
