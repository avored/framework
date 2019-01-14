<?php

namespace AvoRed\Framework\Api\Resources\Property;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyDropdownOptionCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
