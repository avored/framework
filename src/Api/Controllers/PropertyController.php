<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Api\Resources\Property\PropertyResource;
use AvoRed\Framework\Api\Resources\Property\PropertyCollectionResource;
use AvoRed\Framework\Product\Requests\PropertyRequest;

class PropertyController extends Controller
{
    /**
     * Return upto 10 Record for an Resource in Json Formate
     *
     * @return \Illuminate\Http\Resources\CollectsResources
     */
    public function index()
    {
        $properties = Property::paginate(10);

        return new PropertyCollectionResource($properties);
    }

    /**
     * Create an Resource and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(PropertyRequest $request)
    {
        $property = Property::create($request->all());

        return (new PropertyResource($property));
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    /**
     * Update and Returns a Json Resrouce for that Record
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->all());
        return new PropertyResource($property);
    }

    /**
     * Destroy an Record and Return Null Json Response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return JsonResponse::create(null, 204);
    }
}
